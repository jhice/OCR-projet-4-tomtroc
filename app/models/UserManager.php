<?php

/**
 * Classe qui gère les utilisateurs.
 */

class UserManager extends AbstractEntityManager
{
    /**
     * Récupère un user par son login.
     * @param string $login
     * @return ?User
     */
    public function getUserByLogin(string $login) : ?User 
    {
        $sql = "SELECT * FROM users WHERE login = :login";
        $result = $this->db->query($sql, ['login' => $login]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }
    
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
     * On sait si l'user est un nouveau user car son id sera -1.
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
     * @param User $user : le user à ajouter.
     * @return void
     */
    public function addUser(User $user): void
    {
        $sql = "INSERT INTO users (login, password, nickname) VALUES (:login, :password, :nickname)";
        $this->db->query($sql, [
            'login' => $user->getLogin(),
            'password' => $user->getPassword(),
            'nickname' => $user->getNickname(),
        ]);
    }

    /**
     * Modifie un user.
     * @param User $user : le user à modifier.
     * @return void
     */
    public function updateUser(User $user): void
    {
        $sql = "UPDATE users SET title = :title, content = :content, WHERE id = :id";
        $this->db->query($sql, [
            'login' => $user->getLogin(),
            'password' => $user->getPassword(),
            'nickname' => $user->getNickname(),
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
