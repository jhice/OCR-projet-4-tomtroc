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
        $search = Utils::request("search", "");

        $bookManager = new BookManager();
        // on transmet la recherche éventuelle au manager
        $books = $bookManager->getAllBooks($search);

        $view = new View("Nos livres à l'échange");
        $view->render("book/books", [
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
        $view->render("book/book", [
            'book' => $book,
        ]);
    }

    /**
     * Formulaire d'ajout de livre
     */
    public function add()
    {
        // l'utilisateur doit être connecté
        $this->checkIfUserIsConnected();

        $book = new Book();

        // POST ?
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {

            // vérification des champs
            // print_r($_POST);
            $title = Utils::request("title");
            $author = Utils::request("author");
            $comment = Utils::request("comment");
            $available = (bool) Utils::request("available");
            // var_dump($available);

            if (!$title || !$author || !$comment || $available === null) {
                throw new Exception("Tous les champs sont requis.", 422);
            }

            // mise à jour du livre
            $book->setTitle($title);
            $book->setAuthor($author);
            $book->setComment($comment);
            $book->setAvailable($available);
            // user
            $book->setUserId($_SESSION["idUser"]);
            // print_r($book);
            $this->uploadCover($book);

            // mise à jour BDD
            $bookManager = new BookManager();
            $bookManager->save($book);

            // on redirige vers le compte
            Utils::redirect("user", [
                "id" => $_SESSION["idUser"],
            ]);
        }

        // rendu de la vue
        $view = new View("Ajout livre ");
        $view->render("book/add", [
            'book' => $book,
        ]);
    }

    /**
     * Formulaire de modification de livre
     */
    public function edit()
    {
        // echo $_GET["action"];
        // l'utilisateur doit être connecté
        $this->checkIfUserIsConnected();

        // on récupère l'id du livre
        $id = (int) Utils::request("id");

        // le livre doit exister
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);

        if (!$book) {
            throw new Exception("Le livre demandé n'existe pas.", 404);
        }

        // le livre doit appartenir à l'utilisateur
        if ($book->getUser()->getId() !== $_SESSION["idUser"]) {
            throw new Exception("Vous n'avez pas la permission de supprimer ce livre.", 403);
        }

        // POST ?
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            // vérification des champs
            // print_r($_POST);
            $title = Utils::request("title");
            $author = Utils::request("author");
            $comment = Utils::request("comment");
            $available = (bool) Utils::request("available");
            // var_dump($available);

            if (!$title || !$author || !$comment || $available === null) {
                throw new Exception("Tous les champs sont requis.", 422);
            }

            // mise à jour du livre
            $book->setTitle($title);
            $book->setAuthor($author);
            $book->setComment($comment);
            $book->setAvailable($available);
            // photo
            $this->uploadCover($book);

            // mise à jour BDD
            $bookManager->save($book);

            // on redirige vers le compte
            Utils::redirect("user", [
                "id" => $_SESSION["idUser"],
            ]);
        }

        // rendu de la vue
        $view = new View("Edition " . $book->getTitle());
        $view->render("book/edit", [
            'book' => $book,
        ]);
    }

    /**
     * Upload book cover
     */
    private function uploadCover(Book $book)
    {
        // photo
        // @see https://www.phptutorial.net/php-tutorial/php-file-upload/
        $has_file = isset($_FILES['photo']);
        if ($has_file && $_FILES['photo']['name'] !== "") {
            $filename = $_FILES['photo']['name'];
            $tmp = $_FILES['photo']['tmp_name'];
            // new file location
            $filepath = UPLOAD_DIR . '/' . $filename;
            // move the file to the upload dir
            $success = move_uploaded_file($tmp, $filepath);
            // photo data
            $book->setPhoto($filename);
        }
    }

    /**
     * Supprime un livre
     */
    public function delete()
    {
        // l'utilisateur doit être connecté
        $this->checkIfUserIsConnected();

        // on récupère l'id du livre
        $id = (int) Utils::request("id");

        // le livre doit exister
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);

        if (!$book) {
            throw new Exception("Le livre demandé n'existe pas.", 404);
        }

        // le livre doit appartenir à l'utilisateur
        if ($book->getUser()->getId() !== $_SESSION["idUser"]) {
            throw new Exception("Vous n'avez pas la permission de supprimer ce livre.", 403);
        }

        // on supprime
        $bookManager->deleteBook($id);

        // on redirige vers le compte
        Utils::redirect("user", [
            "id" => $_SESSION["idUser"],
        ]);
    }
}
