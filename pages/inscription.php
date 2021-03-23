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
                    $message_erreur = "Saisie invalide.";
                    break;
                case 3:
                    $message_erreur = "Le nom d'utilisateur ne peut contenir que des lettres et des chiffres et des tirets (-) ou tirets du bas (_) facultatifs sauf au début à et à la fin. Ex. : <code>jean-dupont75</code>.";
                    break;
                case 4:
                    $message_erreur = "Nom d'utilisateur indisponible.";
                    break;
                case 5:
                    $message_erreur = "Adresse électronique invalide.";
                    break;
                case 6:
                    $message_erreur = "Adresse électronique déjà utilisée.";
                    break;
                case 7:
                    $message_erreur = "Les mots de passe ne se correspondent pas.";
                    break;
                case 8:
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
                case 9:
                    $message_erreur = "Veuillez accepter les conditions d'utilisation.";
                    break;
                default:
                    $message_erreur = "";
                    break;
            }
            echo "<div class='message-erreur'>$message_erreur</div>";
        }
    ?>

<h2>Inscription</h2>

<div class="contenu">
    <form action="./traitement/traitement.php?inscription" method="POST" id="formulaire-inscription">
    
        <!-- javascript -->
    
        <div class="champ-formulaire">
            <input type="checkbox" id="termes" name="termes" value="true">
            <label for="termse">J'ai lu et accepté les conditions d'utilisation.</label>
        </div>
    
    </form>
    
    <p class="centrer-texte">Vous déjà un compte&thinsp;? <a href="./?connexion">Se connecter.</a></p>
</div>

<?php
    } else {
?>

<p>Il est interdit de créer un nouveau compte si vous en possédez déjà un.</p>

<p>Si vous ne parvenez à vous y connecter, demander à <a href="./?reinit-mdp">réinitialiser le mot de passe</a> ou <a href="./?contact">contacter l'administrateur</a>.</p>

<?php } ?>