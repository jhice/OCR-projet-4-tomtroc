<?php

/**
 * Contrôleur de la partie admin.
 */

class AdminController
{

    /**
     * Affiche la page d'administration.
     * @return void
     */
    public function showAdmin(): void
    {
        // On vérifie que l'utilisateur est connecté.
        $this->checkIfUserIsConnected();

        // On récupère les articles.
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();

        // On affiche la page d'administration.
        $view = new View("Administration");
        $view->render("admin", [
            'articles' => $articles
        ]);
    }

    /**
     * Vérifie que l'utilisateur est connecté.
     * @return void
     */
    private function checkIfUserIsConnected(): void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("login");
        }
    }

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
    public function registerUser(): void
    {
        // On récupère les données du formulaire.
        $login = Utils::request("login");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($login) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // On vérifie que l'utilisateur n'existe pas déjà
        $userManager = new UserManager();
        $user = $userManager->getUserByLogin($login);
        if ($user) {
            throw new Exception("Ce nom d'utilisateur est déjà utilisé.");
        }

        // On hache le mot de passe avec l'algorithme bcrypt, pour stockage sécurisé en BDD
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // On enregistre l'utilisateur
        $user = new User([
            "login" => $login,
            "password" => $hashedPassword,
            "nickname" => $login,
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
    public function connectUser(): void
    {
        // On récupère les données du formulaire.
        $login = Utils::request("login");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($login) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByLogin($login);
        if (!$user) {
            throw new Exception("Nom d'utilisateur ou mot de passe erroné.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Nom d'utilisateur ou mot de passe erroné.");
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
    public function disconnectUser(): void
    {
        // On déconnecte l'utilisateur.
        unset($_SESSION['user']);
        unset($_SESSION['idUser']);

        // On redirige vers la page d'accueil.
        Utils::redirect("home");
    }

    /**
     * Affichage du formulaire d'ajout d'un article.
     * @return void
     */
    public function showUpdateArticleForm(): void
    {
        $this->checkIfUserIsConnected();

        // On récupère l'id de l'article s'il existe.
        $id = Utils::request("id", -1);

        // On récupère l'article associé.
        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($id);

        // Si l'article n'existe pas, on en crée un vide. 
        if (!$article) {
            $article = new Article();
        }

        // On affiche la page de modification de l'article.
        $view = new View("Edition d'un article");
        $view->render("updateArticleForm", [
            'article' => $article
        ]);
    }

    /**
     * Ajout et modification d'un article. 
     * On sait si un article est ajouté car l'id vaut -1.
     * @return void
     */
    public function updateArticle(): void
    {
        $this->checkIfUserIsConnected();

        // On récupère les données du formulaire.
        $id = Utils::request("id", -1);
        $title = Utils::request("title");
        $content = Utils::request("content");

        // On vérifie que les données sont valides.
        if (empty($title) || empty($content)) {
            throw new Exception("Tous les champs sont obligatoires. 2");
        }

        // On crée l'objet Article.
        $article = new Article([
            'id' => $id, // Si l'id vaut -1, l'article sera ajouté. Sinon, il sera modifié.
            'title' => $title,
            'content' => $content,
            'id_user' => $_SESSION['idUser']
        ]);

        // On ajoute l'article.
        $articleManager = new ArticleManager();
        $articleManager->addOrUpdateArticle($article);

        // On redirige vers la page d'administration.
        Utils::redirect("admin");
    }

    /**
     * Suppression d'un article.
     * @return void
     */
    public function deleteArticle(): void
    {
        $this->checkIfUserIsConnected();

        $id = Utils::request("id", -1);

        // On supprime l'article.
        $articleManager = new ArticleManager();
        $articleManager->deleteArticle($id);

        // On redirige vers la page d'administration.
        Utils::redirect("admin");
    }

    /**
     * Affiche la page d'administration.
     * @return void
     */
    public function showMonitoring(): void
    {
        // On vérifie que l'utilisateur est connecté.
        $this->checkIfUserIsConnected();

        // On récupère les articles.
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();

        // Récupération des infos pour le tri : colonne et sens
        $sortColumn = $_GET['colonne'] ?? 'titre';
        $sortOrder = $_GET['sens'] ?? 'asc';
        // On tri les articles
        $sortedArticles = $articleManager->sortArticles($articles, $sortColumn, $sortOrder);

        // On affiche la page d'administration.
        $view = new View("Monitoring");
        $view->render("monitoring", [
            'articles' => $sortedArticles,
            'sortColumn' => $sortColumn,
            'sortOrder' => $sortOrder,
        ]);
    }

    /**
     * Affichage les commentaires d'un article.
     * @return void
     */
    public function showArticleComments(): void
    {
        $this->checkIfUserIsConnected();

        // On récupère l'id de l'article s'il existe.
        $id = Utils::request("articleId", -1);

        // On récupère l'article associé.
        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($id);

        // Si l'article n'existe pas, erreur
        if (!$article) {
            throw new Exception("L'article demandé n'existe pas.");
        }

        // On va chercher les commentaires
        $commentManager = new CommentManager();
        $comments = $commentManager->getAllCommentsByArticleId($id);

        // On affiche la page de modification de l'article.
        $view = new View("Edition d'un article");
        $view->render("viewComments", [
            'article' => $article,
            'comments' => $comments,
        ]);
    }

    /**
     * Suppression d'un commentaire.
     * @return void
     */
    public function deleteComment(): void
    {
        $this->checkIfUserIsConnected();

        $id = Utils::request("id", -1);

        // On récupère le commentaire.
        $commentManager = new CommentManager();
        $comment = $commentManager->getCommentById($id);

        // Si le commentaire n'existe pas, erreur
        if (!$comment) {
            throw new Exception("Le commebtaire demandé n'existe pas.");
        }
        
        // On supprime le commentaire
        $commentManager->deleteComment($comment);

        // On met à jour le nombre de commentaires
        $articleManager = new ArticleManager();
        // On transmet l'article du commentaire
        $articleManager->updateCommentCount($articleManager->getArticleById($comment->getIdArticle()));

        // On redirige vers l'article d'origine
        Utils::redirect("viewComments&articleId=" . $comment->getIdArticle());
    }
}
