<?php

/**
 * Affiche une manche (image) d'une partie de TimeGuessr.
 */


?>

<h1>Round <?php echo $args['current_round'] ?></h1>

<form action="<?php echo $args['next_url']; ?>" method="post">
    <input type="submit" value="Proposer">
</form>