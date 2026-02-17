<?php

/**
 * Fournit une connexion à la base de données MySQL
 */

/**
 * Charge le fichier d'environnement du projet (contient les accès base de données)
 *
 * @param string $path
 * @return void
 */
function load_env(string $path): void
{
	if (! is_readable($path)) {
		throw new RuntimeException(".env file not found: $path");
	}

	$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

	foreach ($lines as $line) {

		$line = trim($line);

		if ($line === '' || str_starts_with($line, '#')) {
			continue;
		}

		[$key, $value] = explode('=', $line, 2);

		$key   = trim($key);
		$value = trim($value);

		// suppression éventuelle des quotes
		$value = trim($value, "\"'");

		$_ENV[$key] = $value;
		putenv("$key=$value");
	}
}

// Charge les variables d'environnement dans $_ENV
load_env(__DIR__ . '/../.env');

/**
 * Retourne une instance de PDO (connexion à la base de données) initialisée uniquement au 1er appel.
 *
 * @return PDO
 */
function getPDO(): PDO
{
	static $pdo = null;

	if ($pdo === null) {
		$dsn = sprintf(
			'mysql:host=%s;dbname=%s;charset=%s',
			$_ENV['DB_HOST'],
			$_ENV['DB_NAME'],
			$_ENV['DB_CHARSET']
		);

		$pdo = new PDO(
			$dsn,
			$_ENV['DB_USER'],
			$_ENV['DB_PASSWORD'],
			[
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES   => false,
			]
		);
	}

	return $pdo;
}


/**
 * Retourne un ensemble d'images aléatoires pour une partie de timeguessr
 *
 * @return array
 */
function find_five_random_images(): array
{
	//Remarque : améliorer en ajoutant une seed pour produire des résultats reproductibles.
	$sql = "
        SELECT id, path, latitude, longitude, annee
        FROM image
        ORDER BY RAND()
        LIMIT 5
    ";

	return getPDO()->query($sql)->fetchAll();
}