<?php

/**
 * Charge et retourne le rendu d'un template HTML
 *
 * @param string $name Le nom du template (ex. "home.php").
 * @param array  $args Les arguments à passer au template sous forme de tableau associatif.
 *
 * @return string Le contenu HTML généré par le template.
 */
function render_template( string $name, array $args = array() ): string {
	ob_start();
	// Path Relatif au script appelant (le fichier controller.php ici)
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
function display_template( string $name, array $args = array() ): void {
	echo render_template( $name, $args );
	exit;
}

function controller_home( $args ) {
	display_template(
		'home.php',
		array()
	);
}


function controller_show_round_result( $args ) {
	$current_round = $_SESSION['game']['round'];

	// Calculer le score
	++$_SESSION['game']['score'];

	// Avancer au prochain round
	++$_SESSION['game']['round'];

	$next_round_url = sprintf( 'round?step=%d', $_SESSION['game']['round'] );
	display_template(
		'round-result.php',
		array(
			'current_round'  => $current_round,
			'next_round_url' => $next_round_url,
			'game_over_url'  => 'game-over',
			'round_score'    => $_SESSION['game']['score'],
		)
	);
}

/**
 * GET /round
 *
 * @param [type] $args
 * @param [type] $http_method
 * @return void
 */
function controller_new_round( $args, $http_method ) {

	$current_round = $_SESSION['game']['round'];

	if ( $current_round > 5 ) {
		header( 'Location: game-over' );
		exit;
	}

	$image                           = array_shift( $_SESSION['game']['images'] );
	$_SESSION['game']['round_image'] = $image;

	display_template(
		'round.php',
		array(
			'result_url'    => '/round-result',
			'current_round' => $current_round,
			'image'         => $image,
		)
	);
}

/**
 * POST /new-game
 *
 * @param [type] $args
 * @return void
 */
function controller_new_game( $args ) {
	// Reset session
	$_SESSION['game'] = array(
		'round'   => 1,
		'score'   => 0,
		'history' => array(),
	);

	// Récupérer 5 random images et les mettre en cache en session.
	$images                     = find_five_random_images();
	$_SESSION['game']['images'] = $images;

	// Redirect to first round.
	header( 'Location: round?step=1' );
	exit;
}


function controller_round_image() {

	// Cherche l'image sur le disque (repertoire privé)
	$file_path = __DIR__ . '/../images/' . basename( $_SESSION['game']['round_image']['path'] );

	if ( ! file_exists( $file_path ) ) {
		http_response_code( 404 );
        trigger_error("Impossible de trouver le fichier image", E_ERROR);
		exit;
	}

	$ext  = strtolower( pathinfo( $file_path, PATHINFO_EXTENSION ) );
	$mime = match ( $ext ) {
		'jpg', 'jpeg' => 'image/jpeg',
		'png'         => 'image/png',
		'webp'        => 'image/webp',
		default       => 'application/octet-stream',
	};

	header( 'Content-Type: ' . $mime );
	// Ecrit l'image sur la sortie standard, récupéré par le navigateur pour afficher l'image
	readfile( $file_path );
	exit;
}

function controller_game_over() {

	// Récupérer le score
	$score    = $_SESSION['game']['score'];
	$_SESSION = array();
	// Supprimer sessions
	session_destroy();
	// Supprimer le cookie de session (laissé en exercice)
	// Afficher page de fin de jeu (score final)

	display_template(
		'game-over.php',
		array(
			'score' => $score,
		)
	);
}
