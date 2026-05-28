<?php 

class ArticleController 
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {
        // $articleManager = new ArticleManager();
        // $articles = $articleManager->getAllArticles();

        $view = new View("Tom Troc");
        $view->render("home");
    }

    /**
     * Affiche "nos livres à l'échange".
     * @return void
     */
    public function showBooks() : void
    {
        // $articleManager = new ArticleManager();
        // $articles = $articleManager->getAllArticles();

        $view = new View("Nos livres à l'échange");
        $view->render("livres");
    }
}