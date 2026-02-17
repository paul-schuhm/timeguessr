<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Score round : <?php echo $args['round_score']; ?></h2>
    <p>
        <?php if ($args['current_round'] == 5) : ?>
            <a href="<?php echo $args['game_over_url'] ?>">Voir score final</a>
        <?php else: ?>
            <a href="<?php echo $args['next_round_url'] ?>">Image suivante</a>
        <?php endif; ?>
    </p>
</body>

</html>