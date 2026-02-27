<?php
/**
 * Moteur de templates
 */

/**
 * Charge et retourne le rendu d'un template HTML
 *
 * @param string $name Le nom du template (ex. "home.php").
 * @param array  $args Les arguments à passer au template sous forme de tableau associatif.
 *
 * @return string Le contenu HTML généré par le template.
 */
function render_template(string $name, array $args = array()): string
{
    ob_start();
    require __DIR__ . "/views/{$name}";
    return ob_get_clean();
}

/**
 * Charge, génère et affiche le rendu d'un template HTML, puis arrête le script.
 *
 * @param string $name Le nom du template (ex. "home.php").
 * @param array  $args Les arguments à passer au template sous forme de tableau associatif.
 *
 * @return void Cette fonction ne retourne rien, elle affiche directement le contenu.
 */
function display_template(string $name, array $args = array()): void
{
    echo render_template($name, $args);
    exit;
}
