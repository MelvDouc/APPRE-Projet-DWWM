<main>

    <h2>Nous contacter</h2>

    <form action="./processing/processing.php?contact" method="POST" id="contact-form">
    
        <div class="form-field">
            <label for="first-name">Prénom</label>
            <input type="text" name="first-name" id="first-name" required>
        </div>

        <div class="form-field">
            <label for="last-name">Nom de famille</label>
            <input type="text" name="last-name" id="last-name" required>
        </div>

        <div class="form-field">
            <label for="email-address">Adresse email</label>
            <input type="email" name="email-address" id="email-address" required>
        </div>

        <!-- <div class="form-field">
            <label for=""></label>
            <input type="text" name="" id="">
        </div> -->

        <div class="form-field">
            <label for="contact-subject">Sujet</label>
            <select name="contact-subject" id="contact-subject">
                <option value="test">test</option>
            </select>
        </div>

        <div class="contact-message-field">
            <label for="contact-message">Message</label>
            <textarea name="contact-message" id="contact-message" rows="5" required></textarea>
        </div>

        <div class="form-submit">
            <button type="submit">Valider</button>
        </div>
    
    </form>

</main>