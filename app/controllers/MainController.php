<?php

/**
 * Gère la page d'accueil et les pages statiques
 */

class MainController extends AbstractController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function home(): void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getBooksForHome();
        // print_r($books);

        $view = new View("Partage et découvertes littéraires");
        $view->render("main/home", [
            "books" => $books,
        ]);
    }
}
