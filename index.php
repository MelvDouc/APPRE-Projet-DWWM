<?php
    session_start();
    require "./traitement/bdd.php";    
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require "./include/head.inc.html"; ?>
    <?php if(isset($_GET["fiche-livre"])) { ?>
        <script src="./assets/js/fiche-livre.js" defer></script>
    <?php } ?>
    <title>L'Alpha-Bêtise</title>
</head>

<body>

    <?php require "./include/header.inc.php"; ?>

    <main>

    <?php
    
    if(isset($_GET["accueil"]) || empty($_GET)) {

        require "./pages/accueil.php";

    } else if(isset($_GET["rencontres"])) {

        require "./pages/rencontres.php";

    } else if(isset($_GET["conseils-de-lecture"])) {
        
        require "./pages/conseils.php";
    
    } else if(isset($_GET["contact"])) {
        
        require "./pages/contact.php";
        
    } else if(isset($_GET["fiche-livre"]) && isset($_GET["id"])) {
        
        require "./pages/fiche-livre.php";

    } else if(isset($_GET["connexion"])) {

        require "./pages/connexion.php";

    } else if(isset($_GET["inscription"])) {
        
        require "./pages/inscription.php";

    } else if(isset($_GET["profil"])) {

        require "./pages/profil.php";

    } else if(isset($_GET["confirmer-email"])) {

        require "./traitement/valider-compte.php";

    } else if (isset($_GET["reinit-mdp"])) {
        
        require "./pages/reinit-mdp.php";

    } else if(isset($_GET["creer-nouveau-mot-de-passe"])) {

        require "./traitement/creer-nouveau-mdp.php";

    } else if(isset($_GET["confirmation-envoi-lien-reinitialisation-mot-de-passe"])) {

        require "./pages/notifs/confirmation-envoi-reinit.html";

    } else if(isset($_GET["acces-refuse"])) {
        
        require "./pages/notifs/acces-refuse.html";
        
    } else if(isset($_GET["compte-cree"])) {

        require "./pages/notifs/compte-cree.html";

    } else if (isset($_GET["confirmation-envoi-message"])) {

        require "./pages/notifs/confirmation-envoi-message.html";

    }

    ?>

    </main>

    <?php require "./include/footer.inc.html"; ?>

</body>

</html>