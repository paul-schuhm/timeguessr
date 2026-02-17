<?php

/**
 * Démo de connection à une base de données MySQL avec PDO.
 */

/*
Prérequis : 

- Serveur MySQL en cours d'execution sur la machine
- Avoir installé l'extension 'pdo_mysql'. Voir https://www.php.net/manual/fr/pdo.installation.php. Vérifier que l'extension est présente avec la commande : php -m (liste modules installés et activés)
- Avoir une base de données 'timeguessr' avec un utilisateur qui dispose des droits dessus

Pour acceder à la base :

- URL de la base de données : nom de la base, l'hote (sur quelle machine est le serveur mysql)
- Credentials d'un user de la base : login et mdp
- Port standardisé (par défaut) pour MySQL : 3306
*/

//Données (a exeternaliser dans un fichier d'environnement sécurisé ou a conserver secret, ne pas le commit sur un dépot public !)
$host = 'localhost';
$db_name = "timeguessr";
$user = 'dev';
$password = 'dev';

// Utiliser la fonction sprintf() pour créer la chaine DSN a partir des données :
$dsn = sprintf("mysql:host=%s;dbname=%s;charset=utf8mb4", $host, $db_name);

//Options pour controler le comportement de PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

//Tentative de connexion à la base de données
try {
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    //Si une exception est levée, ce bloc est executé.
    //On affiche l'erreur pour mieux debug
    var_dump($e);
    echo "Erreur de connexion à la base de données";
    exit;
}

//Emettre une requête SQL via la variable $pdo avec la méthode query()

//Deux solutions :

//1. Récuperer ligne par ligne en itérant sur l'objet Statement

//Objet 'Statement' que je peux parcourir, ligne par ligne
$stat = $pdo->query('SELECT * FROM Image WHERE id=1');
// foreach($stat as $row){
//     //var_dump($row);
// }

//2. OU récupérer tout d'un coup avec la métode fetchAll()
//Récupérer tous les résultats de la requête.
$images = $stat->fetchAll();
var_dump($images);


//Exemple d'insert (update, delete fonctionnent exactement de la même façon) via pdo avec requête préparée (pour éviter les injections SQL !) 
$sql = 'INSERT INTO Image(id, path) VALUES (:id, :path)';
$stmt = $pdo->prepare($sql);

//Executer la requete
$result = $stmt->execute(
    [
        'id' => 6,
        'path' => 'foo bar'
    ]
);

//Si id auto_incrémenté on peut récupérer l'id généré par la base avec la méthode lastInsertId() :
//$image_id = $pdo->lastInsertId();

//Pattern pour avoir une seule instance ouverte de connexion à la base de données.

/**
 * Retourne une instance de PDO (connexion à la base de données) initialisée uniquement au 1er appel.
 *
 * @return PDO
 */
function open_connection(): PDO
{

    //Données d'acces à la base
    $host = 'localhost';
    $db_name = "timeguessr";
    $user = 'dev';
    $password = 'dev';

    static $pdo = null;

    if ($pdo === null) {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=utf8mb4',
            $host,
            $db_name,

        );

        $pdo = new PDO(
            $dsn,
            $user,
            $password,
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }

    return $pdo;
}


//Usage :

//Si première fois, la connexion est ouverte
$pdo = open_connection();
//Fois suivante, réutilisation de la connexion déjà ouverte (car la variable est static et conserve sa valeur au cours de l'execution)
$pdo = open_connection();