<?php
    if(isset($_SESSION["connexion-utilisateur"]) && $_SESSION["connexion-utilisateur"]) {
        $utilisateur = $_SESSION["utilisateur"];
        $utilisateur = $bdd->query("SELECT * FROM utilisateurs WHERE pseudo = '$utilisateur'")->fetch();
        if($utilisateur["pseudo"] === $_GET["utilisateur"]) {
?>

    <h2>Profil de <?= $utilisateur["pseudo"] ?></h2>

    <a href="./traitement/traitement.php?deconnexion">Déconnexion</a>

        
<?php
        } else {

            header("Location: ./?acces-refuse");

        }
    } else {

        header("Location: ./?acces-refuse");

    } ?>