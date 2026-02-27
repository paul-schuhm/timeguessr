<?php

/**
 * Affiche le score final d'une partie de TimeGuessr.
 */

?>

<?php require __DIR__ . '/parts/header.php'; ?>

<h1>Score</h1>
<h2><?php echo $args['score']; ?> / 50 000</h2>
<p>
    <a href="/new-game">Rejouer</a>
</p>

<?php require  __DIR__ .'/parts/footer.php'; ?>