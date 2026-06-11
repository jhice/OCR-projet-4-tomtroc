<?php

/**
 * Classe qui gère les conversations.
 */

class ConversationManager extends AbstractEntityManager
{
    /**
     * Récupère tous les messages d'une conversation entre 2 utilisateurs.
     * @param Conversation $conversation La conversation concernée
     * @return void
     */
    public function getMessagesFromConversation(Conversation $conversation): void
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
    }

    /**
     * Récupère une conversation entre 2 utilisateurs
     * @param int $user1_id : l'id du user 1.
     * @param int $user2_id : l'id du user 2.
     * @return Conversation|null : un objet Conversation ou null si la conversation n'existe pas.
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
     * Récupère les conversations d'un utilisateur
     * @param int $user_id : l'id du user concerné.
     * @return array : la liste des conversation.
     */
    public function getUserConversations(int $user_id): array
    {
        $sql = "SELECT
            c.*,
            u.nickname,
            u.avatar,
            m.content,
            m.created_at
        FROM conversations c

        JOIN (
            SELECT
                conversation_id,
                MAX(created_at) AS last_message
            FROM messages
            GROUP BY conversation_id
        ) latest
            ON latest.conversation_id = c.id

        JOIN messages m
            ON m.conversation_id = c.id
        AND m.created_at = latest.last_message

        JOIN users u
            ON u.id =
            CASE
                WHEN c.user1_id = :id1 THEN c.user2_id
                ELSE c.user1_id
            END

        WHERE c.user1_id = :id1
        OR c.user2_id = :id1

        ORDER BY m.created_at DESC;";

        $result = $this->db->query($sql, [
            'id1' => $user_id,
        ]);

        $conversations = [];

        while ($conversation = $result->fetch(PDO::FETCH_OBJ)) {
            $conversations[] = $conversation;
        }

        // stdClass Object
        // (
        //     [id] => 2
        //     [nickname] => CamilleClubLit
        //     [avatar] => camille.jpg
        //     [content] => Parfait, je peux proposer Hygge en échange.
        //     [created_at] => 2026-05-19 14:23:00
        // )

        return $conversations;
    }

    /**
     * Récupère l'utilisateur avec qui dialogue le user connecté
     * @param Conversation $conversation La conversation concernée
     * @return User
     */
    public function getRecipient(Conversation $conversation): ?User
    {
        $sql = "SELECT *
            FROM conversations c
            JOIN users u ON (c.user1_id = u.id OR c.user2_id = u.id) AND u.id != :uid
            WHERE c.id = :cid;";

        $result = $this->db->query($sql, [
            'uid' => $_SESSION["idUser"],
            'cid' => $conversation->getId(),
        ]);

        $user = $result->fetch();
        if (!$user) {
            return null;
        }

        return new User($user);
    }

    /**
     * Crée une conversation entre 2 utilisateurs.
     * @param int $user1_id : l'id du user 1.
     * @param int $user2_id : l'id du user 2.
     * @return void
     */
    public function createConversationFromUsers(int $user1_id, int $user2_id): void
    {
        $sql = "INSERT INTO `conversations` (`user1_id`, `user2_id`, `created_at`, `updated_at`)
            VALUES (:id1, :id2, now(), now());";

        $this->db->query($sql, [
            'id1' => $user1_id,
            'id2' => $user2_id,
        ]);
    }

    /**
     * Nombre de messages non lus en attente
     */
    public function getUnreadMessages(): int
    {
        $sql = "SELECT COUNT(*) AS unread
            FROM messages m
            WHERE m.receiver_id = :uid AND is_read = 0
            GROUP BY receiver_id";

        $result = $this->db->query($sql, [
            'uid' => $_SESSION["idUser"],
        ]);

        $total = $result->fetch();

        return (int) $total;
    }

    /**
     * Nombre de conversation du user connecté
     */
    public function getConversationCount(int $id): int
    {
        $sql = "SELECT COUNT(*) AS total
            FROM conversations
            WHERE user1_id = :id1 OR user2_id = :id1";

        $result = $this->db->query($sql, [
            'id1' => $id,
        ]);

        $total = $result->fetch(PDO::FETCH_OBJ)->total;

        return (int) $total;
    }

    /**
     * Dernière conversation du user connecté
     */
    public function getLastConversation(int $id): Conversation
    {
        $sql = "SELECT *
            FROM `conversations`
            WHERE user1_id = :uid OR user2_id = :uid
            ORDER BY created_at DESC
            LIMIT 1";

        $result = $this->db->query($sql, [
            'uid' => $id,
        ]);

        $conversation = $result->fetch();

        return new Conversation($conversation);
    }

    /**
     * Récupère une conversation via son id
     */
    public function getConversationById(int $id): null|Conversation
    {
        $sql = "SELECT *
            FROM `conversations`
            WHERE id = :id
            LIMIT 1";

        $result = $this->db->query($sql, [
            'id' => $id,
        ]);

        if ($result->rowCount() === 0) {
            return null;
        }

        $conversation = $result->fetch();

        return new Conversation($conversation);
    }

    /**
     * Nouveau message
     */
    public function addMessage(int $cid, int $sid, int $rid, string $content)
    {
        // données à ajouter + non lu par défaut
        $sql = "INSERT INTO `messages` (`conversation_id`, `sender_id`, `receiver_id`, `content`, `is_read`, `created_at`)
            VALUES (:cid, :sid, :rid, :content, '0', now());";

        // requête préparée
        $this->db->query($sql, [
            'cid' => $cid,
            'sid' => $sid,
            'rid' => $rid,
            'content' => $content,
        ]);

        
    }
}
