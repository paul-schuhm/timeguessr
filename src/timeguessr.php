<?php

/**
 * Modèle : Règles du jeu timeguessr.
 */

//Empêcher la conversion implicite sur les types primitifs
declare(strict_types=1);

//A implémenter.


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
