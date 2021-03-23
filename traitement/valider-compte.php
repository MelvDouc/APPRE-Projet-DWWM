<?php

if(isset($_GET["cle-verif"])) {

    $cle_verif = $_GET["cle-verif"];
    $etat_verif = 1;
    $req = $bdd->prepare("UPDATE utilisateurs SET etat_verif = :etat_verif WHERE cle_verif = '$cle_verif'");
    $req->bindParam(":etat_verif", $etat_verif, PDO::PARAM_INT);
    $req->execute();

?>

    <div class="hauteur-100 flex-center" id="valider-compte">

        <p>Compte vérifié !</p>
        <p>Vous pouvez à présent <a href="./?connexion">vous connecter à votre compte</a>.</p>

    </div>

<?php

} else {
    header("Location: ../");
    die();
}