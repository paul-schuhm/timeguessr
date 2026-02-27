<?php

/**
 * Le composant router de l'application web.
 */

/*Les Contrôleurs de l'application, executés par le routeur*/
require_once __DIR__ . '/controller.php';

/**
 * Routes de l'application
 */
define('ROUTES', [
    'POST' => [
        '/round' => 'controller_play_round',
        '/round-result' => 'controller_show_round_result',
    ],
    'GET' => [
        '/' => 'controller_show_home',
        '/new-game' => 'controller_new_game',
        '/round' => 'controller_play_round',
        '/round-image' => 'controller_round_image',
        '/game-over' => 'controller_end_game',
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
        call_user_func($callable, $args, $http_method);
    } else {
        /*Contrôler n'existe pas ou mal défini: 500*/
        trigger_error("Controller $callable non callable. Erreur 500", E_USER_WARNING);
        http_response_code(500);
    }
} else {
    /*Ressource n'existe pas : 404*/
    trigger_error("Ressource $http_method $resource n\'existe pas. Erreur 404", E_USER_WARNING);
    http_response_code(404);
}