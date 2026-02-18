<?php

/**
 * Modèle : Règles du jeu timeguessr.
 */

//Empêcher la conversion implicite sur les types primitifs
declare(strict_types=1);


//A implémenter.
function compute_score_round(
    int $guess_year,
    float $guess_lat,
    float $guess_lon,
    int $year,
    float $lat,
    float $lon
): int {
    // Récupérer les données dans $_POST
    // Récupérer les données de l'image courante
    // $image = $_SESSION['game']['round_image'];

    // Calculer le score (à spécifier).
    return compute_score($guess_year, $guess_lat, $guess_lon, $year, $lat, $lon);
}


// A specifier
function compute_score(
    int $guess_year,
    float $guess_lat,
    float $guess_lon,
    int $year,
    float $lat,
    float $lon
): int {
    return 100;
}
