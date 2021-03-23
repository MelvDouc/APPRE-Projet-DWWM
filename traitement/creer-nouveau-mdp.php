<?php if(isset($_GET["cle_mdp"])) {
    $cle_mdp = $_GET["cle_mdp"];

    if(isset($_GET["erreur"])) {
        $message_erreur;
        switch ($_GET["erreur"]) {
            case 1:
                $message_erreur = "Veuillez remplir tous les champs.";
                break;
            case 2:
                $message_erreur = "Les mots de passe ne se correpondent pas.";
                break;
            case 3:
                $argt_liste_erreurs = "";
                    $types_erreur = $_GET["types"];
                    if(str_contains($types_erreur, "majuscules"))
                        $argt_liste_erreurs .= "<li>au moins une majuscule</li>";
                    if(str_contains($types_erreur, "minuscules"))
                        $argt_liste_erreurs .= "<li>au moins une minuscule</li>";
                    if(str_contains($types_erreur, "chiffres"))
                        $argt_liste_erreurs .= "<li>au moins un chiffre</li>";
                    if(str_contains($types_erreur, "ponctuation"))
                        $argt_liste_erreurs .= "<li>au moins un signe de ponctuation</li>";
                    if(str_contains($types_erreur, "longueur_min"))
                        $argt_liste_erreurs .= "<li>au minimum 8 caractères</li>";
                    if(str_contains($types_erreur, "longueur_max"))
                        $argt_liste_erreurs .= "<li>au maximum 20 caractères</li>";
                    $message_erreur = "<ul>Le mot de passe doit contenir :$argt_liste_erreurs</ul>";
                break;
            default:
                $message_erreur = "";
                break;
        }
        echo "<div class='message-erreur'>$message_erreur</div>";
    }
    ?>

    <form action="./traitement/traitement.php?creation-nouveau-mdp" method="POST" id="formulaire-nouveau-mdp">

        <input type="hidden" name="cle_mdp" value="<?= $cle_mdp ?>">

        <div class="champ-formulaire">
            <label for="mdp">Nouveau de mot de passe</label>
            <input type="password" id="mdp" name="mdp">
        </div>

        <div class="champ-formulaire">
            <label for="confirmation_mdp">Confirmer le nouveau mot de passe</label>
            <input type="password" id="confirmation_mdp" name="confirmation_mdp">
        </div>

        <div class="validation-formulaire">
            <button type="submit">Valider</button>
        </div>

    </form>

<?php } else {
    header("Location: ./?accueil");
    die();
} ?>