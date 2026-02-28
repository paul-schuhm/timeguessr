<?php

require_once __DIR__ . '/timeguessr.php';

/**
 * GET /
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
 * 
 * POST /new-game
 * Démarre une nouvelle partie. Initialise l'état du jeu en session.
 *
 * @param array $args
 * @return void
 */
function controller_new_game(): void
{
	// Reset session
	$_SESSION['game'] = array(
		'round'   => 1, // on commence au round 1
		'score'   => 0,
		'history' => array(),
	);

	// Récupérer 5 random images et les mettre en cache en session.
	// Une image par round. index image = $round - 1 
	$images                     = find_five_random_images();
	$_SESSION['game']['images'] = $images;

	// Redirect to first round.
	header('Location: round?id=1');
	exit;
}

/**
 * GET /round?id
 * Affiche le round à jouer (image + formulaire pour faire le guess)
 *
 * @return void
 */
function controller_show_round()
{

	$round_id = intval($_GET['id']);

	//Vérifier que les rounds précédents ont déjà été joués.
	if ($round_id > $_SESSION['game']['round']) {
		//Rediriger vers le dernier round à jouer (round courant)
		$round_id = $_SESSION['game']['round'];
	}

	$is_round_already_played = isset($_SESSION['game']['history'][$round_id]);

	display_template(
		'round.php',
		array(
			'result_url'    => "/round-result?id={$round_id}",
			'round' => $round_id,
			'image'         => $_SESSION['game']['images'][$round_id - 1],
			'disable_make_guess_btn' => $is_round_already_played,
			'form_data' => [
				'year' => $_SESSION['game']['history'][$round_id]['year'] ?? 1900,
				'lat' => $_SESSION['game']['history'][$round_id]['lat'] ?? 0,
				'lon' => $_SESSION['game']['history'][$round_id]['lon'] ?? 0,
			]
		)
	);
}


/**
 * POST /make-guess
 * Traite la réponse (formulaire de guess) et gestion d'erreur, calcule le score et redirige vers GET /show-result (pattern PRG)
 *
 * @return void
 */
function controller_make_guess()
{

	$round = $_SESSION['game']['round'];

	//Laisser en exercice : traiter le formulaire ($_POST) correctement;
	//Si erreur (données manquantes, invalides), rediriger vers GET /round + message d'erreur.
	$guess_year = $_POST['year'];
	$guess_lon = $_POST['lon'];
	$guess_lat = $_POST['lat'];
	$year = $_SESSION['game']['images'][$round - 1]['annee'];
	$lon =  $_SESSION['game']['images'][$round - 1]['longitude'];
	$lat =  $_SESSION['game']['images'][$round - 1]['latitude'];

	$score = compute_score($guess_year, $guess_lat, $guess_lon, $year, $lon, $lat);

	// Calculer le score total
	$_SESSION['game']['score'] += $score;

	// Enregistrer les réponses soumises
	$_SESSION['game']['history'][$round] = [
		'year' => $guess_year,
		'lat' => $guess_lat,
		'lon' => $guess_lon,
		'score' => $score
	];

	// Redirect to show result.
	$next_url = sprintf("round-result?id=%d", $_SESSION['game']['round']);

	header("Location: {$next_url}");
	exit;
}

/**
 * GET /round-result?id
 * Affiche le résultat du dernier round joué et le moyen de jouer le round suivant.
 */
function controller_show_round_result(): void
{

	$round_id = intval($_GET['id']);
	$score = $_SESSION['game']['history'][$round_id]['score'];

	display_template(
		'round-result.php',
		array(
			'round'  => $round_id,
			'score'    => $score,
		)
	);
}

/**
 * POST /next-round
 * Fait avancer l'état du jeu (round suivant) et redirige vers GET /round pour le jouer.
 *
 * @return void
 */
function controller_next_round(): void
{
	++$_SESSION['game']['round'];
	// Redirige vers le prochain round à jouer.
	$next_url = sprintf("round?id=%d", $_SESSION['game']['round']);
	header("Location: {$next_url}");
	exit;
}


/**
 * GET /game-over
 * Affiche l'écran de fin de partie avec le score final et termine le jeu courant (session)
 * Propose de rejouer une partie
 */
function controller_show_end_game(): void
{

	//Tentative d'accéder au game-over avant d'avoir terminer la partie.
	if (!isset($_SESSION['game']['history'][5])) {
		//A implementer... Rediriger vers la prochaine manche à jouer
	}

	// Afficher page de fin de jeu (score final)
	display_template(
		'game-over.php',
		array(
			'score' => $_SESSION['game']['score'],
			'history' => $_SESSION['game']['history']
		)
	);
}

/**
 * GET /round-image
 * Retourne l'image du round courant.
 * @return void
 */
function controller_round_image(): void
{

	$round_id = intval($_GET['id']);
	$index = $round_id - 1;

	if (!isset($_SESSION['game']['images'][$index])) {
		trigger_error("Incorrect image index");
	}

	// Cherche l'image sur le disque (repertoire privé)
	$file_path = __DIR__ . '/../images/' . basename($_SESSION['game']['images'][$index]['path']);

	if (! file_exists($file_path)) {
		http_response_code(404);
		trigger_error('Impossible de trouver le fichier image', E_USER_ERROR);
		exit;
	}

	//Définit le bon mime-type (pour le header HTTP)
	$ext  = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
	$mime = match ($ext) {
		'jpg', 'jpeg' => 'image/jpeg',
		'png'         => 'image/png',
		'webp'        => 'image/webp',
		default       => 'application/octet-stream',
	};

	// Écrit l'image sur la sortie standard, récupéré par le navigateur pour afficher l'image
	header('Content-Type: ' . $mime);
	readfile($file_path);
	exit;
}
