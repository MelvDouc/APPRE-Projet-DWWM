<?php if(!isset($_SESSION["connexion-utilisateur"])) { ?>

    <section id="reinit-mdp">

        <h2>Réinitialiser le mot de passe</h2>

        <form action="./traitement/traitement.php?reinit-mdp" method="POST" id="formulaire-reinit">
    
            <div class="champ-formulaire">
                <label for="courriel">Votre adresse email</label>
                <input type="email" id="courriel" name="courriel" required>
            </div>

            <div class="validation-formulaire">
                <button type="submit">Valider</button>
            </div>

        </form>

        <?php if(isset($_GET["erreur"])) {
            $message_erreur;
            switch ($_GET["erreur"]) {
                case 1:
                    $message_erreur = "Veuillez saisir une adresse électronique valide.";
                    break;
                case 2:
                    $message_erreur = "Nous n'avons pas de compte avec cette adresse électronique.";
                    break;
                default:
                    $message_erreur = "";
                    break;
            }
            echo "<div class='erreur-flash'>$message_erreur</div>";
        } ?>

    </section>

<?php } else {
    header("Location: ./?accueil");
} ?>