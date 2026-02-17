<?php

/**
 * Point d'entrée de l'application (site), "Front-Controller"
 * Charge les dépendances (kernel)
 * Charge la configuration (.env, etc.)
 * Charge et appelle le composant 'Router' (association URL/Code a executer ou "Controller")
 */

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../src/controller.php';
require_once __DIR__ . '/../src/router.php';

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