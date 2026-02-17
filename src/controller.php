<?php

/**
 * Charge et retourne le rendu d'un template HTML
 *
 * @param string $name Le nom du template (ex. "home.php").
 * @param array $args Les arguments à passer au template sous forme de tableau associatif.
 *
 * @return string Le contenu HTML généré par le template.
 */
function render_template(string $name, array $args = []): string
{
    ob_start();
    // Path Relatif au script appelant (le fichier controller.php ici)
    require __DIR__ . "/views/{$name}";
    return ob_get_clean();
}

/**
 * Charge, génère et affiche le rendu d'un template HTML, puis arrête le script.
 *
 * @param string $name Le nom du template (ex. "home.php").
 * @param array $args Les arguments à passer au template sous forme de tableau associatif.
 *
 * @return void Cette fonction ne retourne rien, elle affiche directement le contenu.
 */
function display_template(string $name, array $args = []): void
{
    echo render_template($name, $args);
    exit;
}


function controller_round_result($args)
{
    //Calculer le score
    $_SESSION['game']['score']++;

    $next_round_url = sprintf("round?step=%d", $_SESSION['game']['round']);
    display_template('round-result.php', [
        'current_round' => $_SESSION['round'],
        'next_round_url' => $next_round_url 
    ]);
}


function controller_round($args)
{

    $_SESSION['game'] = [
        'score' => $_SESSION['game']['score'] + 1,
        'round' => $_SESSION['game']['round'] + 1,
        'history' => []
    ];

    $current_round = $_SESSION['game']['round'];

    if ($current_round > 5) {

        //Récupérer le score
        $score = $_SESSION['game']['score'];
        $_SESSION = [];
        //Supprimer sessions
        session_destroy();
        //Supprimer le cookie de session (laissé en exercice)
        //Afficher page de fin de jeu (score final)

        header('Location: game-over');
    } else {

        $current_round_result_url = "/result";

        display_template('round.php', [
            'result_url' => $current_round_result_url
        ]);
    }
}


function controller_new_game()
{
    //Init session
    //Reset session
    $_SESSION['game'] = [
        'score' => 0,
        'round' => 0,
        'history' => []
    ];

    // Redirect to first round.
    header('Location: round?step=1');
    exit;
}


function controller_game_over()
{
    exit('Game Over. Results to print...');
}
