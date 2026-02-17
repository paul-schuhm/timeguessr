<?php
/*
Le protocole HTTP est stateless "sans état", le serveur oublie le client une fois qu'il lui a répondu. Il nous revient donc d'implémenter le mécanisme de "session",c'est a dire d'une communication entre client et serveur où le serveur reconnait le client.

PHP dispose d'un mécanisme de stockage persistant (mais temporaire) de données. Cela permet de faciliter
la création et la gestion de "sessions", par l'intermédiaire d'un cookie.
*/

//Génere un token aléatoire (PHPSESSID), le dépose en cookie chez le client. Ce cookie sert d'identifiant unique du client. Ce cookie sera envoyé automatiquement avec toutes les requêtes (GET ou POST) vers le serveur.

//Si le cookie déjà présent avec l'identifiant de session dans la requete (ou l'URL), , PHP n'en recree pas,  PHP le lit et charge les valeurs du tableau $_SESSION associé à cet identifiant. Chaque identifiant a un tableau de valeurs associé.
session_start();

//Stocker temporairement des données associées à l'ID
//Etat maintenu coté serveur. Par exemple, état du jeu timeguessr.

//Initialisation du jeu
if (!$_SESSION['game']['init']) {
    $_SESSION['game']['round'] = 1;
    $_SESSION['game']['score'] = 0;
    //Récuperer les 5 images.
    $_SESSION['game']['images'] = [];
    //Flag: marquer le jeu comme initialisé.
    $_SESSION['game']['init'] = true;
}

?>

<h1>Bienvenue</h1>

<h2>Round <?php echo $_SESSION['game']['round']; ?></h2>

<p>Une démo d'un prototype de cycle de jeu dans une session (partie)</p>

<p>
    Jouer puis
    <a href="next-round.php">Round suivant</a>
</p>

<p>
    <a href="logout.php">Réinitialiser le jeu</a>
</p>