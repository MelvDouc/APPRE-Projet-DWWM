<main>
    
    <?php
        if(isset($_GET["error"])) {    
            $error_message;
            switch ($_GET["error"]) {
                case 1:
                    $error_message = "Veuillez remplir tous les champs.";
                    break;
                case 2:
                    $error_message = "Saisie invalide.";
                    break;
                case 3:
                    $error_message = "Le nom d'utilisateur ne doit pas contenir d'espace.";
                    break;
                case 4:
                    $error_message = "Nom d'utilisateur indisponible.";
                    break;
                case 5:
                    $error_message = "Adresse électronique invalide.";
                    break;
                case 6:
                    $error_message = "Adresse électronique déjà utilisée.";
                    break;
                case 7:
                    $error_message = "Les mots de passe ne se correspondent pas.";
                    break;
                case 8:
                    $error_list_items = "";
                    $error_types = $_GET["errortypes"];
                    if(str_contains($error_types, "uppercase"))
                        $error_list_items .= "<li>au moins une majuscule</li>";
                    if(str_contains($error_types, "lowercase"))
                        $error_list_items .= "<li>au moins une minuscule</li>";
                    if(str_contains($error_types, "number"))
                        $error_list_items .= "<li>au moins un chiffre</li>";
                    if(str_contains($error_types, "punctuation"))
                        $error_list_items .= "<li>au moins un signe de ponctuation</li>";
                    if(str_contains($error_types, "min_length"))
                        $error_list_items .= "<li>au minimum 8 caractères</li>";
                    if(str_contains($error_types, "max_length"))
                        $error_list_items .= "<li>au maximum 20 caractères</li>";
                    $error_message = "<ul>Le mot de passe doit contenir :$error_list_items</ul>";
                    break;
                case 9:
                    $error_message = "Veuillez accepter les conditions d'utilisation.";
                    break;
                default:
                    $error_message = "";
                    break;
            }
            echo "<div class='flash-error'>$error_message</div>";
        }
    ?>

    <h2>Inscription</h2>

    <form action="./processing/processing.php?register" method="POST" id="register-form">
    
        <div class="form-field">
            <label for="first-name">Prénom</label>
            <input type="text" id="first-name" name="first-name" required>
        </div>

        <div class="form-field">
            <label for="last-name">Nom de famille</label>
            <input type="text" id="last-name" name="last-name" required>
        </div>

        <div class="form-field">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div class="form-field">
            <label for="email-address">Adresse email</label>
            <input type="email" id="email-address" name="email-address" required>
        </div>

        <div class="form-field">
            <label for="pwd">Mot de passe</label>
            <input type="password" id="pwd" name="pwd" required>
        </div>

        <div class="form-field">
            <label for="confirm-pwd">Confirmer mot de passe</label>
            <input type="password" id="confirm-pwd" name="confirm-pwd" required>
        </div>

        <div class="form-field">
            <input type="checkbox" id="terms" name="terms" value="true">
            <label for="terms">J'ai lu et accepté les conditions d'utilisation.</label>
        </div>

        <div class="form-submit">
            <button type="submit">Valider</button>
        </div>
    
    </form>

</main>
