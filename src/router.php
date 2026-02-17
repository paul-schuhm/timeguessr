<?php

/**
 * Le composant router de l'application web.
 */

/**
 * Routes de l'application
 */
define('ROUTES', [
    'POST' => [
        '/round' => 'controller_round',
        '/round-result' => 'controller_round_result',
        '/game-over' => 'controller_game_over',
    ],
    'GET' => [
        '/new-game' => 'controller_new_game',
        '/round' => 'controller_round',
    ]
]);

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
