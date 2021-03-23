<?php
    if(isset($_SESSION["connexion-utilisateur"]) && $_SESSION["connexion-utilisateur"]) {
        $pseudo_utilisateur = $_SESSION["utilisateur"];
        $u = $bdd->query("SELECT * FROM utilisateurs WHERE pseudo = '$pseudo_utilisateur'")->fetch();
        if($u["pseudo"] === $_GET["utilisateur"]) {
?>

    <h2>Profil de <?= $u["pseudo"] ?></h2>

    <div class="contenu" id="profil-u">

        <h3>Vos informations</h3>

        <table>
            <tr>
                <th>Adresse email</th>
                <td><?= $u["adresse_email"] ?></td>
            </tr>
            <tr>
                <th>Prénom</th>
                <td><?= $u["prenom"] ?></td>
            </tr>
            <tr>
                <th>Nom de famille</th>
                <td><?= $u["nom_de_famille"] ?></td>
            </tr>
            <tr>
                <th>Date de naissance</th>
                <td><?= $u["date_de_naissance"] ?></td>
            </tr>
            <tr>
                <th>Adresse</th>
                <td><?= $u["adresse_postale"] ?></td>
            </tr>
            <tr>
                <th>Code postal</th>
                <td><?= $u["code_postal"] ?></td>
            </tr>
            <tr>
                <th>Ville</th>
                <td><?= $u["ville"] ?></td>
            </tr>
            <tr>
                <th>Pays</th>
                <td><?= $u["pays"] ?></td>
            </tr>
            <tr>
                <th>Inscrit depuis</th>
                <td><?= $u["date_creation"] ?></td>
            </tr>
        </table>

        <a id="btn-modifier-profil" href="./?modifier-profil&utilisateur=<?= $u["pseudo"] ?>">
            <button>Modifier le profil</button>
        </a>


    </div>


    <a href="./traitement/traitement.php?deconnexion">Déconnexion</a>

        
<?php
        } else {

            header("Location: ./?acces-refuse");

        }
    } else {

        header("Location: ./?acces-refuse");

    } ?>