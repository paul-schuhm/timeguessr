<?php

/**
 * Affiche le score final d'une partie de TimeGuessr.
 */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Score</h1>
    <h2><?php echo $args['score']; ?></h2>
    <p>
        <a href="/new-game">Rejouer</a>
    </p>
</body>

</html>