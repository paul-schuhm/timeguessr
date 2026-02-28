<?php

/**
 * Affiche la page d'accueil du site.
 */

?>

<?php require __DIR__ . '/parts/header.php'; ?>

<h1>TimeGuessr</h1>

<form action="/new-game" method="POST">
    <input type="submit" name="new_game" value="Nouvelle partie">
</form>

<?php require  __DIR__ .'/parts/footer.php'; ?>