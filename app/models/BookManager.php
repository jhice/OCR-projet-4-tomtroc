<?php

/**
 * Classe qui gère les livres.
 */

class BookManager extends AbstractEntityManager
{
    /**
     * Récupère tous les livres de la page d'accueil.
     * @return array : un tableau d'objets Book.
     */
    public function getBooksForHome(): array
    {
        $sql = "SELECT * FROM books ORDER BY id DESC LIMIT 4";
        $result = $this->db->query($sql);
        $books = [];

        $userManager = new UserManager();

        while ($book = $result->fetch()) {
            $newBook = new Book($book);
            // association user ?
            if ($newBook->getUserId()) {
                $user = $userManager->getUserById($newBook->getUserId());
                if ($user) {
                    // permet d'associer l'objet directement
                    $newBook->setUser($user);
                }
            }
            // push to list
            $books[] = $newBook;
        }

        // print_r($books);

        return $books;
    }

    /**
     * Récupère tous les livres.
     * @return array : un tableau d'objets Book.
     */
    public function getAllBooks(): array
    {
        $sql = "SELECT * FROM books ORDER BY id DESC";
        $result = $this->db->query($sql);
        $books = [];

        $userManager = new UserManager();

        while ($book = $result->fetch()) {
            $newBook = new Book($book);
            // association user ?
            if ($newBook->getUserId()) {
                $user = $userManager->getUserById($newBook->getUserId());
                if ($user) {
                    // permet d'associer l'objet directement
                    $newBook->setUser($user);
                }
            }
            // push to list
            $books[] = $newBook;
        }

        return $books;
    }

    /**
     * Récupère tous les livres d'un utilisateur donné
     * @return array : un tableau d'objets Book.
     */
    public function getAllBooksFromUser(User $user): array
    {
        $sql = "SELECT * FROM books WHERE user_id = :id ORDER BY id ASC";
        $result = $this->db->query($sql, ['id' => $user->getId()]);
        $books = [];

        $userManager = new UserManager();

        while ($book = $result->fetch()) {
            $newBook = new Book($book);
            // push to list
            $books[] = $newBook;
        }

        return $books;
    }

    /**
     * Récupère un book par son id.
     * @param int $id : l'id du book.
     * @return Book|null : un objet Book ou null si le book n'existe pas.
     */
    public function getBookById(int $id): ?Book
    {
        $sql = "SELECT * FROM books WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $book = $result->fetch();
        if ($book) {
            $newBook = new Book($book);
            $userManager = new UserManager();
            // association user ?
            if ($newBook->getUserId()) {
                $user = $userManager->getUserById($newBook->getUserId());
                if ($user) {
                    // permet d'associer l'objet directement
                    $newBook->setUser($user);
                }
            }
            return $newBook;
        }
        return null;
    }

    /**
     * Ajoute ou modifie un book.
     * On sait si l'book est un nouvel book car son id sera -1.
     * @param Book $book : l'book à ajouter ou modifier.
     * @return void
     */
    public function save(Book $book): void
    {
        if ($book->getId() == -1) {
            $this->addBook($book);
        } else {
            $this->updateBook($book);
        }
    }

    /**
     * Ajoute un book.
     * @param Book $book : l'book à ajouter.
     * @return void
     */
    public function addBook(Book $book): void
    {
        $sql = "INSERT INTO books (title, comment, author, available, photo, user_id) VALUES (:title, :comment, :author, :available, :photo, :user_id)";
        $this->db->query($sql, [
            'title' => $book->getTitle(),
            'comment' => $book->getComment(),
            'author' => $book->getAuthor(),
            'available' => (int) $book->getAvailable(),
            'photo' => $book->getPhoto(),
            'user_id' => $book->getUserId(),
        ]);
    }

    /**
     * Modifie un book.
     * @param Book $book : l'book à modifier.
     * @return void
     */
    public function updateBook(Book $book): void
    {
        $sql = "UPDATE books SET title = :title, comment = :comment, author = :author, available = :available, photo = :photo WHERE id = :id";
        $this->db->query($sql, [
            'title' => $book->getTitle(),
            'comment' => $book->getComment(),
            'author' => $book->getAuthor(),
            'available' => (int) $book->getAvailable(),
            'photo' => $book->getPhoto(),
            'id' => $book->getId()
        ]);
    }

    /**
     * Supprime un book.
     * @param int $id : l'id de l'book à supprimer.
     * @return void
     */
    public function deleteBook(int $id): void
    {
        $sql = "DELETE FROM books WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }
}
