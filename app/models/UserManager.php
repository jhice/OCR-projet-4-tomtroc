<?php

/**
 * Classe qui gère les utilisateurs.
 */

class UserManager extends AbstractEntityManager
{
    /**
     * Récupère tous les utilisateurs.
     * @return array : un tableau d'objets User.
     */
    public function getAllUsers(): array
    {
        $sql = "SELECT * FROM users ORDER BY id ASC";
        $result = $this->db->query($sql);
        $users = [];

        while ($user = $result->fetch()) {
            $users[] = new User($user);
        }

        return $users;
    }

    /**
     * Récupère un user par son id.
     * @param int $id : l'id du user.
     * @return User|null : un objet User ou null si le user n'existe pas.
     */
    public function getUserById(int $id): ?User
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }

        return null;
    }

    /**
     * Ajoute ou modifie un user.
     * On sait si l'user est un nouvel user car son id sera -1.
     * @param User $user : l'user à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateUser(User $user): void
    {
        if ($user->getId() == -1) {
            $this->addUser($user);
        } else {
            $this->updateUser($user);
        }
    }

    /**
     * Ajoute un user.
     * @param User $user : l'user à ajouter.
     * @return void
     */
    public function addUser(User $user): void
    {
        $sql = "INSERT INTO users (id_user, title, content, date_creation) VALUES (:id_user, :title, :content, NOW())";
        $this->db->query($sql, [
            'id_user' => $user->getIdUser(),
            'title' => $user->getTitle(),
            'content' => $user->getContent()
        ]);
    }

    /**
     * Modifie un user.
     * @param User $user : l'user à modifier.
     * @return void
     */
    public function updateUser(User $user): void
    {
        $sql = "UPDATE users SET title = :title, content = :content, date_update = NOW() WHERE id = :id";
        $this->db->query($sql, [
            'title' => $user->getTitle(),
            'content' => $user->getContent(),
            'id' => $user->getId()
        ]);
    }

    /**
     * Supprime un user.
     * @param int $id : l'id de l'user à supprimer.
     * @return void
     */
    public function deleteUser(int $id): void
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }
    
}
