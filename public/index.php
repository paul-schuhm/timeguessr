<?php

/**
 * Point d'entrée de l'application (site), "Front-Controller"
 * Charge les dépendances (kernel)
 * Charge la configuration (.env, etc.)
 * Charge et appelle le composant 'Router' (association URL/Code a executer ou "Controller")
 */

declare(strict_types=1);

// Connexion Base de données (object $pdo)
require __DIR__ . '/../src/database.php';

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
