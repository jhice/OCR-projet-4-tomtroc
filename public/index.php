<?php

require_once '../framework/config/autoload.php';
require_once '../framework/config/helpers.php';
require_once '../app/config/config.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {

        // pages publiques et livres

        case 'home':
            $mainController = new MainController();
            $mainController->home();
            break;

        case 'livres':
            $bookController = new BookController();
            $bookController->list();
            break;

        case 'livre':
            $bookController = new BookController();
            $bookController->show();
            break;

        // utilisateurs

        case 'user':
            $userController = new UserController();
            $userController->show();
            break;

        case 'register':
            $userController = new UserController();
            $userController->displayRegisterForm();
            break;

        case 'register_post':
            $userController = new UserController();
            $userController->register();
            break;

        case 'user_update':
            $userController = new UserController();
            $userController->update();
            break;

        case 'login':
            $userController = new UserController();
            $userController->displayConnectionForm();
            break;

        case 'connect':
            $userController = new UserController();
            $userController->connect();
            break;

        case 'logout':
            $userController = new UserController();
            $userController->disconnect();
            break;
        
        // user book

        case 'book_add':
            $bookController = new BookController();
            $bookController->add();
            break;

        case 'book_edit':
            $bookController = new BookController();
            $bookController->edit();
            break;

        case 'book_delete':
            $bookController = new BookController();
            $bookController->delete();
            break;

        // conversations

        case 'inbox':
            $conversationController = new ConversationController();
            $conversationController->inbox();
            break;

        case 'messages':
            $conversationController = new ConversationController();
            $conversationController->show();
            break;

        case 'write':
            $conversationController = new ConversationController();
            $conversationController->write();
            break;

        // 404

        default:
            throw new Exception("La page demandée n'existe pas.", 404);
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('global/error_page', [
        'errorMessage' => $e->getMessage(),
        // Le code transmis peut être utilisé pour le statut HTTP de réponse
        'errorCode' => $e->getCode()
    ]);
}
