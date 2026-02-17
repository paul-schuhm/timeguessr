<?php

/**
 * Affiche la page d'accueil du site.
 */

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TIMEGUESSR</title>
</head>

<body>

    <h1>TimeGuessr</h1>

    <form action="/new-game" method="get">
        <input type="submit" name="new_game" value="Nouvelle partie">
    </form>
</body>

</html>