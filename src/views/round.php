<?php

/**
 * Affiche une manche (image) d'une partie de TimeGuessr.
 */

?>

<?php require 'parts/header.php'; ?>

<h1>Round <?php echo $args['current_round'] ?></h1>

<div>
    <img src="round-image" alt="" width="400">
</div>

<form action="<?php echo $args['result_url']; ?>" method="post">
    <div>
        <label for="year">Année :</label>
        <input type="number" name="year" id="year" value="1950">
    </div>
    <div>
        <label for="lat"> Latitude : </label>
        <input type="number" name="lat" id="lat" value="48" step="0.1">
        <label for="lon"> Longitude :
        </label>
        <input type="number" name="lon" id="lon" value="40" step="0.1">
    </div>
    <input type="submit" value="Proposer">
</form>

<?php require 'parts/footer.php'; ?>