<?php

/**
 * Point d'entrée de l'application (site), "Front-Controller"
 * Charge les dépendances (kernel)
 * Charge la configuration (.env, etc.)
 * Charge et appelle le composant 'Router' (association URL/Code a executer ou "Controller")
 */

require_once '../src/controller.php';


/**
 * Routes de l'application
 */
define('ROUTES', [
    'POST' => [
        '/round' => 'controller_round',
        '/game-over' => 'controller_game_over'
    ],
    'GET' => [
        '/new-game' => 'controller_new_game',
        '/round' => 'controller_round',
    ]
]);

//Routing

$parts = parse_url($_SERVER['REQUEST_URI']);
$args = array();
parse_str($parts['query'] ?? '', $args);
$resource = $parts['path'];
$http_method = $_SERVER['REQUEST_METHOD'];
$is_route = isset(ROUTES[$http_method][$resource]);

if ($is_route) {

    $callable = ROUTES[$http_method][$resource];

    if (is_callable($callable)) {
        call_user_func($callable, $args);
    } else {
        /*Contrôler n'existe pas ou mal défini: 500*/
        trigger_error('Controler non callable. Erreur 500', E_USER_WARNING);
    }
} else {
    /*Ressource n'existe pas : 404*/
    trigger_error('Ressource n\'existe pas. Erreur 404', E_USER_WARNING);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>TimeGuessr</h1>

    <form action="/new-game" method="get">
        <input type="submit" name="new_game" value="Nouvelle partie">
    </form>
</body>

</html>