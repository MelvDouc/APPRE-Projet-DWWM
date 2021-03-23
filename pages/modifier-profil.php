<?php
    if(isset($_SESSION["connexion-utilisateur"]) && $_SESSION["connexion-utilisateur"]) {
        $pseudo_utilisateur = $_SESSION["utilisateur"];
        $u = $bdd->query("SELECT * FROM utilisateurs WHERE pseudo = '$pseudo_utilisateur'")->fetch();
        if($u["pseudo"] === $_GET["utilisateur"]) {
?>

        <h2>Modifier votre profil</h2>

        <div class="contenu">

            <form action="./traitement/traitement.php?modifier-profil&id=<?= $u["id"] ?>" method="POST" id="formulaire-modif-profil">
                
                <div class="champ-formulaire">
                    <label for="pseudo">Nom d'utilisateur</label>
                    <input type="text" id="pseudo" name="pseudo" placeholder="<?= $u["pseudo"] ?>">
                </div>
                
                <div class="champ-formulaire">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" placeholder="<?= $u["prenom"] ?>">
                </div>
                
                <div class="champ-formulaire">
                    <label for="nom_de_famille">Nom de famille</label>
                    <input type="text" id="nom_de_famille" name="nom_de_famille" placeholder="<?= $u["nom_de_famille"] ?>">
                </div>
                
                <div class="champ-formulaire">
                    <label for="date_de_naissance">Date de naissance (AAAA-MM-JJ)</label>
                    <input type="text" id="date_de_naissance" name="date_de_naissance" placeholder="<?php
                        echo ($u["date_de_naissance"] === null) ? "1990-12-03" : $u["date_de_naissance"];
                    ?>">
                </div>
                
                <div class="champ-formulaire">
                    <label for="adresse_postale">Adresse</label>
                    <input type="text" id="adresse_postale" name="adresse_postale" placeholder="<?= $u["adresse_postale"] ?>">
                </div>
                
                <div class="champ-formulaire">
                    <label for="code_postal">Code postal</label>
                    <input type="number" id="code_postal" name="code_postal" placeholder="<?= $u["code_postal"] ?>">
                </div>
                
                <div class="champ-formulaire">
                    <label for="ville">Ville</label>
                    <input type="text" id="ville" name="ville" placeholder="<?= $u["ville"] ?>">
                </div>
                
                <div class="champ-formulaire">
                    <label for="pays">Pays</label>
                    <input type="text" id="pays" name="pays" placeholder="<?= $u["pays"] ?>">
                </div>
                
                <div class="validation-formulaire">
                    <button type="submit">Valider</button>
                    <a href="./?profil&utilisateur=<?= $u["pseudo"] ?>">Annuler</a>
                </div>

            </form>

        </div>


<?php
        } else {
            header("Location: ./?acces-refuse");
        }
    } else {
        header("Location: ./?acces-refuse");
    }
?>