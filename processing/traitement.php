<?php

// ====================
// ====================
// ====================

// function verifEmail($var){
//     if(!filter_var($var, FILTER_VALIDATE_EMAIL)){
//         echo 'Adresse email non conforme.';
//         return false;
//     } return true;
// }


if(isset($_GET['inscription'])){

    /* Variables */
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $mdp1 = $_POST['mdp1'];
    $mdp2 = $_POST['mdp2'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $code_postal = $_POST['code_postal'];
    if($_POST['newsletter'] == 'oui'){
        $newsletter = 1;
    }else{
        $newsletter = 0;
    }
    if(isset($_FILES)){
        $avatar = time() . strrchr($_FILES['avatar']['name'], '.');
    }
    $date_inscription = date('Y-m-d H:i:s');

    /* Conditions */
    if($pseudo == null || $email == null || $mdp1 == null || $mdp2 == null){
        echo 'Veuillez remplir tous les champs.';
        var_dump($_POST);
        // header('Location: index.php)';
    } else{
        $recherche1 = $bdd->query('SELECT * FROM utilisateurs WHERE pseudo=\'' . $pseudo . '\'')->fetch();
        if($recherche1 != false){
            echo 'Nom d\'utilisateur indisponible';
            // header('Location: index.php)';
        } else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo 'Adresse email invalide.';
            } else{
                $recherche2 = $bdd->query('SELECT * FROM utilisateurs WHERE email=\'' . $email . '\'')->fetch();
                if($recherche2 != false){
                    echo 'Adresse email indisponible.';
                    // header('Location: index.php)';
                } else{
                    if($mdp1 != $mdp2){
                        echo 'Mot de passe de confirmation invalide.';
                        var_dump($_POST);
                        // header('Location: index.php)';
                    } else{
                        if($code_postal === '' || ($code_postal >= 1000 & $code_postal <= 99999)){
                            if($_FILES['avatar']['size'] < 2000000 || $_FILES['avatar']['name'] == ''){
                                if(strlen($_FILES['avatar']['name']) == 0 || $_FILES['avatar']['type'] == 'image/jpg' ||
                                $_FILES['avatar']['type'] == 'image/jpeg' ||
                                $_FILES['avatar']['type'] == 'image/gif' ||
                                $_FILES['avatar']['type'] == 'image/png'){

                                    $req = $bdd->prepare('INSERT INTO utilisateurs (pseudo, email, mdp, adresse, ville, code_postal, newsletter, avatar, date_inscription) VALUES (:pseudo, :email, :mdp, :adresse, :ville, :code_postal, :newsletter, :avatar, :date_inscription)');
        
                                    $mdp = password_hash($mdp2, PASSWORD_DEFAULT);
        
                                    $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
                                    $req->bindParam(':email', $email, PDO::PARAM_STR);
                                    $req->bindParam(':mdp', $mdp, PDO::PARAM_STR);
                                    $req->bindParam(':adresse', $adresse, PDO::PARAM_STR);
                                    $req->bindParam(':ville', $ville, PDO::PARAM_STR);
                                    $req->bindParam(':code_postal', $code_postal);
                                    $req->bindParam(':newsletter', $newsletter);
                                    $req->bindParam(':avatar', $avatar, PDO::PARAM_STR);
                                    $req->bindParam(':date_inscription', $date_inscription);
        
                                    $req->execute();
        
                                    move_uploaded_file($_FILES['avatar']['tmp_name'], './img/' . $avatar);

				    $_SESSION['email'] = $email;

                                    var_dump($req);
                                    header('Location: index.php');
                                } else{
                                    echo 'Type de fichier invalide&thinsp;: veuillez choisir un fichier de type JPG, PNG ou GIF.';
                                    var_dump($_FILES);
                                }
                            } else{
                                echo 'Fichier trop volumineux. 2&thinsp;Mo maximum.';
                            }
                        } else{
                            echo 'Code postal invalide.';
                            var_dump($_POST);
                            // header('Location: index.php)';
                        }
                    }
                }
            }
        }
    }
}

else if(isset($_GET['modification'])){
    $id = (INT)$_GET['modification'];
    
    // if($_POST['pseudo'] === ''){
    //     $pseudo = $bdd->query('SELECT pseudo FROM utilisateurs WHERE id=' . $id)->fetch();
    // } else{
    //     $pseudo = $_POST['pseudo'];
    // }

    $ancienAvatar = $bdd->query('SELECT avatar FROM utilisateurs WHERE id=' . $id)->fetch();
    // print_r($id);
    // print_r($ancienAvatar);
    $date_modif = date('Y-m-d H:i:s');

    $format = strrchr($_FILES['avatar']['name'], '.');

    if($_POST['newsletter'] === 'oui'){
        $newsletter = 1;
    }
    else{
        $newsletter = 0;
    }

    if($ancienAvatar != null){
        if($format == null){
            $avatar = null; 
        } else{
            $avatar = time() . $format;
        }
        
        if($ancienAvatar != null){
            if($format == null){
                $avatar = $ancienAvatar['avatar'];
            } else{
                unlink('./img/' . $ancienAvatar['avatar']);
                $avatar = time() . $format;
                move_uploaded_file($_FILES['avatar']['tmp_name'], './img/' . $avatar);
            }
        } else{
            if($format == null){
                $avatar == null;
            } else{
                $avatar = time() . $format;
                move_uploaded_file($_FILES['avatar']['tmp_name'], './img/' . $avatar);
            }
        }
    }

    $req = $bdd->prepare('UPDATE utilisateurs SET pseudo=:pseudo, email=:email, mdp=:mdp, adresse=:adresse, ville=:ville, code_postal=:code_postal, newsletter=:newsletter, date_modif=:date_modif, avatar=:avatar WHERE id=' . $id);

    $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $req->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $req->bindParam(':mdp', password_hash($_POST['mdp'], PASSWORD_DEFAULT), PDO::PARAM_STR);
    $req->bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
    $req->bindParam(':ville', $_POST['ville'], PDO::PARAM_STR);
    $req->bindParam(':code_postal', $_POST['code_postal'], PDO::PARAM_STR);
    $req->bindParam(':newsletter', $newsletter);
    $req->bindParam(':date_modif', $date_modif);
    $req->bindParam(':avatar', $avatar);

    $req->execute();

    echo 'Les modifications ont bien été prises en compte.<br>Vous allez être redirigé vers la page d\'accueil. Sinon, cliquez <a href="index.php">ici</a>.';
    header('Location: index.php?profil='.$id);

}


    else if(isset($_GET['connexion'])){
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    if($email === '' || $mdp === ''){
        echo 'Veuillez remplir tous les champs.';
    } else{
        $data = $bdd->query('SELECT * FROM utilisateurs WHERE email=\'' . $_POST['email'] . '\'')->fetch();
        if($data['email'] == false){
            echo 'Adresse email non trouvée.';
        } else{
            if(!password_verify($mdp, $data['mdp'])){ // MOT DE PASSE CRYPTÉ EN 2e !
                echo 'Mauvais mot de passe.';
            } else{
                $_SESSION['connected'] = true;
                header('Location: index.php?profil=' . $data['id']);
            }
        }
    }
}