<?php if(isset($_GET["erreur"])) {
    $message_erreur;
    switch ($_GET["erreur"]) {
        case 1:
            $message_erreur = "Veuillez renseigner les champs requis.";
            break;
        case 2:
            $message_erreur = "Sasie invalide.";
            break;
        case 3:
            $message_erreur = "Adresse électronique invalide.";
            break;
        default:
            $message_erreur = "";
            break;
    }
    echo "<div class='message-erreur'>$message_erreur</div>";
} ?>

<h2>Nous contacter</h2>

<form action="./traitement/traitement.php?contact" method="POST" id="formulaire-contact">

    <div class="champ-formulaire">
        <label for="prenom" class="champ-requis">Prénom</label>
        <input type="text" name="prenom" id="prenom" required>
    </div>

    <div class="champ-formulaire">
        <label for="nom_de_famille" class="champ-requis">Nom de famille</label>
        <input type="text" name="nom_de_famille" id="nom_de_famille" required>
    </div>

    <div class="champ-formulaire">
        <label for="pseudo">Nom d'utilisateur (si vous avez un compte)</label>
        <input type="text" name="pseudo" id="pseudo">
    </div>

    <div class="champ-formulaire">
        <label for="courriel" class="champ-requis">Adresse email</label>
        <input type="email" name="courriel" id="courriel" required>
    </div>

    <div class="champ-formulaire">
        <label for="contact_sujet" class="champ-requis">Sujet</label>
        <select name="contact_sujet" id="contact_sujet">
            <option value="test 1">test 1</option>
            <option value="test2">test 2</option>
        </select>
    </div>

    <div class="champ-contact-message">
        <label for="contact_message" class="champ-requis">Message</label>
        <textarea name="contact_message" id="contact_message" rows="5" required></textarea>
    </div>

    <div class="validation-formulaire">
        <button type="submit">Valider</button>
    </div>

</form>