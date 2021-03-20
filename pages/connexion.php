<?php
    if(!isset($_SESSION["connexion-utilisateur"]) || !$_SESSION["connexion-utilisateur"]) {
?>

<?php

    if(isset($_GET["erreur"])) {
        $message_erreur;
        switch ($_GET["erreur"]) {
            case 1:
                $message_erreur = "Veuillez remplir tous les champs.";
                break;
            case 2:
                $message_erreur = "Informations de connexion invalides.";
                break;
            case 3:
                $message_erreur = "Utilisateur non trouvé ou mot de passe invalide.";
                break;
            case 4:
                $message_erreur = "Vous devez d'abord vérifier votre compte pour vous connecter. Suivez le lien indiqué dans le mail de vérification envoyé à la création du compte.";
                break;
            default:
                $message_erreur = "";
                break;
        }
        echo "<div class='message-erreur'>$message_erreur</div>";
    
    } else if(isset($_GET["reinitialisation-mot-de-passe"]) && $_GET["reinitialisation-mot-de-passe"] === "succes") {

        echo "<div class='message-succes'>Votre mot de pase a bien été réinitialisé. Vous pouvez à présent vous connecter.</div>";

    }

?>

    <h2>Connexion</h2>

    <form action="./traitement/traitement.php?connexion" method="POST" id="formulaire-connexion">
    
        <div class="champ-formulaire">
            <label for="id_connexion">Nom d'utilisateur ou adresse email</label>
            <input type="text" id="id_connexion" name="id_connexion">
        </div>

        <div class="champ-formulaire">
            <label for="mdp">Mot de passe</label>
            <input type="password" id="mdp" name="mdp">
        </div>
        
        <p id="reinit-mdp">Mot de passe oublié ? <a href="./?reinit-mdp">Réinitialiser.</a></p>

        <div class="validation-formulaire">
            <button type="submit">Valider</button>
        </div>

    </form>

    <p id="p-connexion">Pas encore de compte&thinsp;? <a href="./?inscription">S'inscrire.</a></p>

<?php
    } else {
?>

    <p>Vous êtes déjà connecté.</p>

<?php } ?>

