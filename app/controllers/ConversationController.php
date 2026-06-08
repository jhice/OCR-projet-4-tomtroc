<?php

class ConversationController
{
    /**
     * Affiche ou crée une conversation entre 2 utilisateurs.
     * @return void
     */
    public function show(): void
    {
        // Récupération de l'id du user demandé.
        $id1 = Utils::request("id1", "");
        $id2 = Utils::request("id2", "");
        // var_dump($id1, $id2);

        // Les 2 ids doivent être présents
        if ($id1 === "" || $id2 === "") {
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
        }

        // messages de la conversation
        $conversationManager->getMessagesFromConversation($conversation);
        print_r($conversation);

        $view = new View("Discussion");
        $view->render("conversation/conversation", [
            "conversation" => $conversation,
        ]);
    }
}
