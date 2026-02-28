<?php

/**
 * Affiche le score final d'une partie de TimeGuessr.
 */

?>

<?php require __DIR__ . '/parts/header.php'; ?>

<h1>Score</h1>
<h2><?php echo $args['score']; ?> / 50 000</h2>
<h2>Détail de la partie</h2>
<!-- Afficher l'historique de la partie proprement -->
<ul>
    <?php foreach ($args['history'] as $round => $data) : ?>
        <li>
            <img src="<?php echo "round-image?id=$round"; ?>" alt="" width="200">
            <p><?php echo $round; ?></p>
            <p><?php echo $data['year']; ?></p>
        </li>
    <?php endforeach; ?>
</ul>
<p>
<form action="/new-game" method="post">
    <input type="submit" value="Rejouer">
</form>
</p>

<?php require  __DIR__ . '/parts/footer.php'; ?>