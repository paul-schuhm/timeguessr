<?php

/**
 * Affiche la page d'accueil du jeu.
 */
function controller_show_home(): void
{
	display_template(
		'home.php',
		array()
	);
}

/**
 * Affiche le résultat du dernier round joué et le moyen de jouer le round suivant.
 */
function controller_show_round_result(): void
{

	$current_round = $_SESSION['game']['round'];

	//A implémenter.
	// $score = compute_score_round();
	$score = 100;

	// Calculer le nouveau score
	$_SESSION['game']['score'] += $score;

	// Avancer au prochain round
	++$_SESSION['game']['round'];

	$next_round_url = sprintf('round?step=%d', $_SESSION['game']['round']);

	display_template(
		'round-result.php',
		array(
			'current_round'  => $current_round,
			'next_round_url' => $next_round_url,
			'game_over_url'  => 'game-over',
			'round_score'    => $score,
		)
	);
}

/**
 * Affiche le round à jouer. Chaque round prend une image dans la sélection.
 * GET /round
 *
 * @return void
 */
function controller_play_round()
{

	$current_round = $_SESSION['game']['round'];

	if ($current_round > 5) {
		header('Location: game-over');
		exit;
	}

	$image                           = array_shift($_SESSION['game']['images']);
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
 * 
 * Démarre une nouvelle partie. Initialise l'état du jeu en session.
 * POST /new-game
 *
 * @param array $args
 * @return void
 */
function controller_new_game(array $args): void
{
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
	header('Location: round?step=1');
	exit;
}


/**
 * Retourne une image parmi les images sélectionnées pour la partie.
 * @return void
 */
function controller_round_image(): void
{

	// Cherche l'image sur le disque (repertoire privé)
	$file_path = __DIR__ . '/../images/' . basename($_SESSION['game']['round_image']['path']);

	if (! file_exists($file_path)) {
		http_response_code(404);
		trigger_error('Impossible de trouver le fichier image', E_USER_ERROR);
		exit;
	}

	$extension  = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
	//Définit le bon mime-type (pour le header HTTP)
	$mime = match ($extension) {
		'jpg', 'jpeg' => 'image/jpeg',
		'png'         => 'image/png',
		'webp'        => 'image/webp',
		default       => 'application/octet-stream',
	};

	header('Content-Type: ' . $mime);
	// Ecrit l'image sur la sortie standard, récupéré par le navigateur pour afficher l'image
	readfile($file_path);
	exit;
}

/**
 * Affiche l'écran de fin de partie avec le score final.
 * GET /game-over
 */
function controller_end_game(): void
{

	// Récupérer le score
	$score    = $_SESSION['game']['score'];
	$_SESSION = array();
	// Supprimer la session
	session_destroy();
	// Supprimer le cookie de session
	if (ini_get('session.use_cookies')) {
		$params = session_get_cookie_params();
		setcookie(
			session_name(),    // nom du cookie de session
			'',                // valeur vide
			time() - 3600,     // date passée provoque la suppression
			$params['path'],
			$params['domain'] ?? '',
			$params['secure'] ?? false,
			$params['httponly'] ?? false
		);
	}

	// Afficher page de fin de jeu (score final)
	display_template(
		'game-over.php',
		array(
			'score' => $score,
		)
	);
}
