<?php

/**
 * Affiche le score final d'une partie de TimeGuessr.
 */

?>

<?php require __DIR__ . '/parts/header.php'; ?>

<h1>Score</h1>
<h2><?php echo $args['score']; ?> / 50 000</h2>
<ul>
    <?php foreach ($args['history'] as $round => $data) : ?>
        <li>
            <img src="" alt="">
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