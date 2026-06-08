<?php

/**
 * Classe qui gère les conversations.
 */

class ConversationManager extends AbstractEntityManager
{
    /**
     * Récupère tous les utilisateurs.
     * @return array : un tableau d'objets User.
     */
    public function getMessagesFromConversation(Conversation $conversation): bool
    {
        $sql = "SELECT c.*, m.*
            FROM conversations c
            JOIN messages m ON m.conversation_id = c.id
            WHERE c.user1_id = :id1
            AND c.user2_id = :id2
            ORDER BY m.created_at ASC;";
        $result = $this->db->query($sql, [
            'id1' => $conversation->getUser1Id(),
            'id2' => $conversation->getUser2Id(),
        ]);

        $messages = [];

        while ($message = $result->fetch()) {
            // print_r($message);
            $messages[] = new Message($message);
        }

        $conversation->setMessages($messages);

        return true;
    }

    /**
     * Récupère un user par son id.
     * @param int $id : l'id du user.
     * @return User|null : un objet User ou null si le user n'existe pas.
     */
    public function getConversationByUsers(int $user1_id, int $user2_id): ?Conversation
    {
        $sql = "SELECT * FROM conversations WHERE user1_id = :id1 AND user2_id = :id2";
        $result = $this->db->query($sql, [
            'id1' => $user1_id,
            'id2' => $user2_id,
        ]);
        $conversation = $result->fetch();
        if (!$conversation) {
            return null;
        }

        // new conversation
        $conversationObject = new Conversation($conversation);
        // add user objects
        $userManager = new UserManager();
        // get users
        $user1 = $userManager->getUserById($conversationObject->getUser1Id());
        $user1->setPassword("");
        $user2 = $userManager->getUserById($conversationObject->getUser2Id());
        $user2->setPassword("");
        // link them to conversation
        $conversationObject->setUser1($user1);
        $conversationObject->setUser2($user2);

        return $conversationObject;
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
}
