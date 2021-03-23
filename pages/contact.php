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

</form>