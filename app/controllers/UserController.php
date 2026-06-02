<?php

class UserController
{
    /**
     * Affiche le compte public d'un auteur.
     * @return void
     */
    public function showUser(): void
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

        $view = new View($user->getNickname());
        $view->render("user", [
            "user" => $user,
            "books" => $books,
        ]);
    }
}
