<?php

/**
 * Point d'entrée de l'application (site), "Front-Controller"
 * Charge les dépendances (kernel)
 * Charge la configuration (.env, etc.)
 * Charge et appelle le composant 'Router' (association URL/Code a executer ou "Controller")
 */

declare(strict_types=1);

// Module fournissant une connexion à la base de données
require __DIR__ . '/../src/database.php';
// Module contenant les procédures pour manipuler les vues
require __DIR__ . '/../src/view.php';
// Module contenant les règles/spécifications du jeu
require __DIR__ . '/../src/timeguessr.php';
/*Les Contrôleurs de l'application, executés par le routeur*/
require __DIR__ . '/../src/controller.php';

//Configuration des cookies
session_set_cookie_params(
	array(
		'lifetime' => 0,       // expire à la fermeture du navigateur
		'path'     => '/',
		'secure'   => true,    // si HTTPS
		'httponly' => true,    // pas accessible via JS
	)
);

session_start();

// Charge et execute le routeur
require_once __DIR__ . '/../src/router.php';
