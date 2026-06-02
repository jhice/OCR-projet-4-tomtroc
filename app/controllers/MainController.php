<?php

class MainController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome(): void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getBooksForHome();
        // print_r($books);

        $view = new View("Tom Troc");
        $view->render("home", [
            "books" => $books,
        ]);
    }

    /**
     * Affiche "nos livres à l'échange".
     * @return void
     */
    public function showBooks(): void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks();

        $view = new View("Nos livres à l'échange");
        $view->render("books", [
            "books" => $books,
        ]);
    }

    /**
     * Affiche le détail d'un livre.
     * @return void
     */
    public function showBook(): void
    {
        // Récupération de l'id du livre demandé.
        $id = Utils::request("id", -1);

        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);

        if (!$book) {
            throw new Exception("Le ivre demandé n'existe pas.", 404);
        }

        $view = new View($book->getTitle());
        $view->render("book", [
            'book' => $book,
        ]);
    }
}
