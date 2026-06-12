<?php

/**
 * Gère conversations et messages
 */

class ConversationController extends AbstractController
{
    /**
     * Décide de quoi faire pour la boîte de réception
     */
    public function inbox()
    {
        $this->checkIfUserIsConnected();

        // toutes les conversations du user connecté (panneau de gauche)
        $conversationManager = new ConversationManager();
        $userConversations = $conversationManager->getConversationCount($_SESSION["idUser"]);
        // print_r($userConversations);

        // si aucune conversation, on affiche un message
        if ($userConversations === 0) {
            throw new Exception("Aucune conversation pour le moment.", 200);
        }

        // on va chercher la dernière conversation à afficher
        $lastConversation = $conversationManager->getLastConversation($_SESSION["idUser"]);

        // on redirige vers la conversation
        Utils::redirect("messages", [
            "id1" => $lastConversation->getUser1Id(),
            "id2" => $lastConversation->getUser2Id(),
        ]);
    }

    /**
     * Affiche ou crée une conversation entre 2 utilisateurs.
     * @return void
     */
    public function show(): void
    {
        $this->checkIfUserIsConnected();

        // Récupération de l'id du user demandé.
        $id1 = Utils::request("id1", "");
        $id2 = Utils::request("id2", "");
        // var_dump($id1, $id2);

        // Les 2 ids doivent être présents, et pas le même id (on ne peut écrire à soi-même)
        if ($id1 === "" || $id2 === "" || $id1 === $id2) {
            throw new Exception("Page non trouvée.", 404);
        }

        // conversion des ids en int
        $id1 = (int) $id1;
        $id2 = (int) $id2;
        // var_dump($id1, $id2);

        // normalisation pour la table, ids en ordre croissant
        if ($id1 < $id2) {
            $user1_id = $id1;
            $user2_id = $id2;
        } else {
            $user1_id = $id2;
            $user2_id = $id1;
        }

        // une conversation existe-t-elle entre ces 2 users ?
        $conversationManager = new ConversationManager();
        $conversation = $conversationManager->getConversationByUsers($user1_id, $user2_id);
        // var_dump($conversation);

        if (!$conversation) {
            // on crée la conversation
            $conversationManager->createConversationFromUsers($user1_id, $user2_id);
            // on la récupère
            $conversation = $conversationManager->getConversationByUsers($user1_id, $user2_id);
        }

        // messages de la conversation
        $conversationManager->getMessagesFromConversation($conversation);
        // print_r($conversation);

        // utilisateur concerné par la conversation (autre que le user connecté)
        $recipient = $conversationManager->getRecipient($conversation);
        // print_r($recipient);

        // toutes les conversations du user connecté (panneau de gauche)
        $userConversations = $conversationManager->getUserConversations($_SESSION["idUser"]);
        // print_r($userConversations);

        $view = new View("Discussion");
        $view->render("conversation/conversation", [
            "userConversations" => $userConversations,
            "recipient" => $recipient,
            "conversation" => $conversation,
        ]);
    }

    /**
     * Ecrire un message
     */
    public function write()
    {
        $this->checkIfUserIsConnected();

        // id de la conversation
        $conversationId = Utils::request("conversation-id", null);
        // id du recipient
        $recipientId = Utils::request("recipient-id", null);

        if ($conversationId === null || $recipientId === null) {
            throw new Exception("Page non trouvée.", 404);
        }

        // on récupère la conversation
        $conversationManager = new ConversationManager();
        $conversation = $conversationManager->getConversationById($conversationId);

        // non trouvée ?
        if ($conversation === null) {
            throw new Exception("Page non trouvée.", 404);
        }

        // contenu
        $content = Utils::request("content");

        // on ajoute le contenu du message à la conversation
        $conversationManager->addMessage($conversationId, $_SESSION["idUser"], $recipientId, $content);

        // on redirige vers la conversation
        Utils::redirect("messages", [
            "id1" => $conversation->getUser1Id(),
            "id2" => $conversation->getUser2Id(),
        ]);
    }
}
