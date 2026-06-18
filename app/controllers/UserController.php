<?php

/**
 * Gère les utilisateurs
 */

class UserController extends AbstractController
{
    /**
     * Affichage du formulaire d'inscription.
     * @return void
     */
    public function displayRegisterForm(): void
    {
        $view = new View("Inscription utilisateur");
        $view->render("user/registration_form");
    }

    /**
     * Inscription de l'utilisateur.
     * @return void
     */
    public function register(): void
    {
        // On récupère les données du formulaire.
        $nickname = Utils::request("nickname");
        $email = Utils::request("email");
        $password = Utils::request("password");

        // On vérifie que les données sont renseignées.
        if (empty($nickname) || empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // le format d'e-mail doit être valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("L'adresse e-mail n'est pas au bon format.");
        }

        // On vérifie que l'e-mail n'existe pas déjà
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);
        if ($user) {
            throw new Exception("Cette adresse e-mail est déjà utilisée.");
        }

        // On hache le mot de passe avec l'algorithme bcrypt, pour stockage sécurisé en BDD
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // On enregistre l'utilisateur
        $user = new User([
            "email" => $email,
            "password" => $hashedPassword,
            "nickname" => $nickname,
            "avatar" => "",
        ]);
        $userManager->addUser($user);

        // On redirige vers la page d'administration.
        Utils::redirect("login");
    }

    /**
     * Affichage du formulaire de connexion.
     * @return void
     */
    public function displayConnectionForm(): void
    {
        $view = new View("Connexion utilisateur");
        $view->render("user/login_form");
    }

    /**
     * Connexion de l'utilisateur.
     * @return void
     */
    public function connect(): void
    {
        // On récupère les données du formulaire.
        $email = Utils::request("email");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);
        if (!$user) {
            throw new Exception("Adresse e-mail ou mot de passe erroné.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Adresse e-mail ou mot de passe erroné.");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        // On redirige vers la page d'administration.
        Utils::redirect("user", ['id' => $user->getId()]);
    }

    /**
     * Déconnexion de l'utilisateur.
     * @return void
     */
    public function disconnect(): void
    {
        // On déconnecte l'utilisateur.
        unset($_SESSION['user']);
        unset($_SESSION['idUser']);

        // On redirige vers la page d'accueil.
        Utils::redirect("home");
    }

    /**
     * Affiche le compte public d'un auteur.
     * @return void
     */
    public function show(): void
    {
        // Récupération de l'id du user demandé.
        $id = Utils::request("id", -1);

        $userManager = new UserManager();
        $user = $userManager->getUserById($id);

        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.", 404);
        }

        // livres de l'utilisateurs
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooksFromUser($user);
        // print_r($books);

        // est-ce le compte du user connecté ?
        if (Utils::isConnectedUser($id)) {
            $template = "user/private_profile";
        } else {
            $template = "user/public_profile";
        }

        $view = new View("Profil de " . $user->getNickname());
        // template selon état du user
        $view->render("user/user", [
            "user" => $user,
            "books" => $books,
        ]);
    }
}
