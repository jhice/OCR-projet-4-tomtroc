<?php 

class MainController 
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
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
    public function showBooks() : void
    {
        // $bookManager = new BookManager();
        // $books = $bookManager->getAllBooks();

        $view = new View("Nos livres à l'échange");
        $view->render("livres");
    }
}