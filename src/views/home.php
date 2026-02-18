<?php

/**
 * Affiche la page d'accueil du site.
 */

?>

<?php require 'parts/header.php'; ?>

<h1>TimeGuessr</h1>

<form action="/new-game" method="get">
    <input type="submit" name="new_game" value="Nouvelle partie">
</form>

<?php require 'parts/footer.php'; ?>