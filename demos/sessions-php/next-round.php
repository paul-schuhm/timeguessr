<?php

//Recharger les données attachées à la session à partir du cookie envoyés.
session_start();
//Acces aux données du jeu
//Incrémente le round;
$_SESSION['game']['round']++ ;
//Redirection en PHP : Rediriger le client (code 302)  vers l'accueil pour  
header('Location: /');
exit;
