<?php require 'parts/header.php'; ?>

<h2>Score round : <?php echo $args['round_score']; ?></h2>
<p>
    <?php if ($args['current_round'] == 5) : ?>
        <a href="<?php echo $args['game_over_url'] ?>">Voir votre score</a>
    <?php else: ?>
        <a href="<?php echo $args['next_round_url'] ?>">Image suivante</a>
    <?php endif; ?>
</p>

<?php require 'parts/footer.php'; ?>