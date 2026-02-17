<?php

/**
 * Affiche une manche (image) d'une partie de TimeGuessr.
 */

?>

<h1>Round <?php echo $args['current_round'] ?></h1>

<div>
    <img src="round-image" alt="" width="400">
</div>

<form action="<?php echo $args['result_url']; ?>" method="post">
    <input type="number" name="year" id="">
    <input type="number" name="location" id="">
    <input type="submit" value="Proposer">
</form>