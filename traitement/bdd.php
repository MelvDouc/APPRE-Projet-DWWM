<?php

    $hote = 'localhost';
    $bdd_nom = 'appre-projet-dwwm';
    $bdd_utilisateur = 'root';
    $bdd_mdp = '';

    $bdd = new PDO('mysql:host=' . $hote . ';dbname=' . $bdd_nom . '; charset=utf8', $bdd_utilisateur, $bdd_mdp);

?>