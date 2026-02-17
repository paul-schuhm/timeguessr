<?php

/**
 * Démo : Exemple d'un router minimaliste et très simple.
 */


// === ROUTER ===

//Recuperer les informations sur la requete HTTP
// - Récuperer l'URL demandée [x]
// - Récupérer les paramètres d'URL [x]
// - Récupérer la méthode HTTP : GET ou POST [x]
//A partir de ces infos => rendre et retourner le bon résultat (page) !

$http_method = $_SERVER['REQUEST_METHOD'];
//Récuperer les parties (composants) de l'URL : Utiliser parse_url()
//@see https://www.php.net/manual/en/function.parse-url.php
$parts = parse_url($_SERVER['REQUEST_URI']);
$path = $parts['path'];


//Récuperer les paramètres d'URL sous forme de tableau associatif : Utiliser parse_str()
//@see https://www.php.net/manual/fr/function.parse-str.php

//Prépare un tableau vide pour stocker les paramètres d'URL sous forme clé=>valeur
$args = [];
parse_str($parts['query'], $args);

//Toutes les infos sur la requête ont été extraites

//Les "routes" de l'application.
$routes = [
    'GET' => [
        '/new-game' => 'new_game'
    ],
    'POST' => [
    ]
];


$controller = $routes[$http_method][$path];

//Si le controller existe et est executable ?
if (is_callable($controller)) {
    //Alors on l'execute
    call_user_func($controller);
}

// == FIN DU ROUTEUR ==


//Un "controlleur": traite requete entrante, produit la réponse (html).
//Appelé pour le router
function new_game()
{
    //Appelle un template (vue) pour produire une réponse
    require 'template-new-game.php';
    exit;
}
