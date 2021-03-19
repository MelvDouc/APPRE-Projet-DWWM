<?php

require_once './processing/db.php';

if(isset($_GET["cle-verif"])) {

    $cle_verif = $_GET["cle-verif"];
    $etat_verif = 1;
    $req = $db->prepare("UPDATE utilisateurs SET etat_verif = :etat_verif WHERE cle_verif = '$cle_verif'");
    $req->bindParam(":etat_verif", $etat_verif, PDO::PARAM_INT);
    $req->execute();

?>

<main>
    <p>Compte vérifié !</p>
    <p><a href="./">Retour à l'accueil</a></p>
</main>

<?php

} else {
    header("Location: ../");
    die();
}