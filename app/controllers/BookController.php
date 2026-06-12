<?php

/**
 * Tout ce qui touche aux livres
 */

class BookController extends AbstractController
{
    /**
     * Affiche "nos livres à l'échange".
     * @return void
     */
    public function list(): void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks();

        $view = new View("Nos livres à l'échange");
        $view->render("main/books", [
            "books" => $books,
        ]);
    }

    /**
     * Affiche le détail d'un livre.
     * @return void
     */
    public function show(): void
    {
        // Récupération de l'id du livre demandé.
        $id = Utils::request("id", -1);

        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);

        if (!$book) {
            throw new Exception("Le livre demandé n'existe pas.", 404);
        }

        $view = new View($book->getTitle());
        $view->render("main/book", [
            'book' => $book,
        ]);
    }
}
