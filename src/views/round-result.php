<?php require __DIR__ . '/parts/header.php'; ?>

<h2>Score round : <?php echo $args['score']; ?></h2>
<p>
    <!-- Si dernier round, aller à la page de game over. -->
    <?php if ($args['round'] == 5) : ?>
        <a href="game-over">Score final</a>
    <?php else: ?>
        <form action="next-round" method="post">
            <input type="submit" value="Image suivante">
        </form>
    <?php endif; ?>
</p>

<?php require  __DIR__ .'/parts/footer.php'; ?>