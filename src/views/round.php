<?php

/**
 * Affiche une manche à jouer (image + form) d'une partie de TimeGuessr.
 */

?>

<?php require __DIR__ . '/parts/header.php'; ?>

<h1>Round <?php echo $args['round'] ?></h1>

<div>
    <img src="round-image?id=<?php echo $args['round']; ?>" alt="" width="400">
</div>

<form action="make-guess" method="post">
    <div>
        <label for="year">Année :</label>
        <input type="number" name="year" id="year" value="<?php echo $args['form_data']['year']; ?>">
    </div>
    <div>
        <label for="lat"> Latitude : </label>
        <input type="number" name="lat" id="lat" value="<?php echo $args['form_data']['lat']; ?>" step="0.1">
        <label for="lon"> Longitude :
        </label>
        <input type="number" name="lon" id="lon" value="<?php echo $args['form_data']['lon']; ?>" step="0.1">
    </div>
    <?php if ($args['disable_make_guess_btn']) : ?>
        <p>Vous avez déjà joué cette manche.</p>
    <?php else : ?>
        <input type="submit" value="Proposer">
    <?php endif; ?>
</form>

<?php require __DIR__ . '/parts/footer.php'; ?>