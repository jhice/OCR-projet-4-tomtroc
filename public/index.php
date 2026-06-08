<?php

require_once '../app/config/config.php';
require_once '../app/config/autoload.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {

        // pages publiques

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

        case 'user':
            $userController = new UserController();
            $userController->showUser();
            break;

        // user

        case 'register':
            $adminController = new AdminController();
            $adminController->displayRegisterForm();
            break;
            
        case 'register_post':
            $adminController = new AdminController();
            $adminController->registerUser();
            break;

        case 'login':
            $adminController = new AdminController();
            $adminController->displayConnectionForm();
            break;

        case 'connect':
            $adminController = new AdminController();
            $adminController->connectUser();
            break;

        case 'logout':
            $adminController = new AdminController();
            $adminController->disconnectUser();
            break;

        // conversation

        case 'messages':
            $conversationController = new ConversationController();
            $conversationController->show();
            break;
            
        default:
            throw new Exception("La page demandée n'existe pas.", 404);
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('global/error_page', [
        'errorMessage' => $e->getMessage(),
        'errorCode' => $e->getCode()
    ]);
}
