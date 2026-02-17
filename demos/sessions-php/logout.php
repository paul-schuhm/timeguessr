<?php
//Charger la session actuelle
session_start();
//Détruire session : supprimer données dans $_SESSION
session_destroy();
//On peut également supprimer le cookie associé (laissé en exercice)
//Redirige vers l'accueil
header('Location: /');
exit;




