<?php

/**
 * Système d'autoload. 
 * A chaque fois que PHP va avoir besoin d'une classe, il va appeler cette fonction 
 * et chercher dnas les divers dossiers (ici models, controllers, views, services) s'il trouve 
 * un fichier avec le bon nom. Si c'est le cas, il l'inclut avec require_once.
 */
spl_autoload_register(function ($className) {

    // On va voir dans le dossier Service si la classe existe.
    if (file_exists('../app/services/' . $className . '.php')) {
        require_once '../app/services/' . $className . '.php';
    }

    // On va voir dans le dossier Model si la classe existe.
    if (file_exists('../app/models/' . $className . '.php')) {
        require_once '../app/models/' . $className . '.php';
    }

    // On va voir dans le dossier Database si la classe existe.
    if (file_exists('../app/models/database/' . $className . '.php')) {
        require_once '../app/models/database/' . $className . '.php';
    }

    // On va voir dans le dossier Controller si la classe existe.
    if (file_exists('../app/controllers/' . $className . '.php')) {
        require_once '../app/controllers/' . $className . '.php';
    }

    // On va voir dans le dossier View si la classe existe.
    if (file_exists('../app/views/' . $className . '.php')) {
        require_once '../app/views/' . $className . '.php';
    }
});
