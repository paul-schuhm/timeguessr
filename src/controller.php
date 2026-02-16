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


function controller_round($args)
{

    $step = intval($args['step']);

    if ($step > 5) {
        //Afficher game over
        display_template('game-over.php', []);
    } else {

        $next_step = $step + 1;
        $next_url = sprintf("round?step=%d", $next_step);
        display_template('round.php', [
            'current_round' => $step,
            'next_url' => $next_url
        ]);
    }
}


function controller_new_game()
{
    // Do some config to prepare the game...

    // Redirect to first round.
    header('Location: round?step=1');
    exit;
}


function controller_game_over()
{
    exit('Game Over. Results to print...');
}
