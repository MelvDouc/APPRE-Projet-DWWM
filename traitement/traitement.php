<?php

session_start();
require_once "./bdd.php";
date_default_timezone_set("Europe/Paris");

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_GET["contact"])) {

	$prenom = $_POST["prenom"];
	$nom_de_famille = $_POST["nom_de_famille"];
	$pseudo = $_POST["pseudo"];
	$courriel = $_POST["courriel"];
	$contact_sujet = $_POST["contact_sujet"];
	$contact_message = $_POST["contact_message"];

	if(strlen($prenom) === 0 || strlen($nom_de_famille) === 0 || strlen($courriel) === 0 || strlen($contact_sujet) === 0 || strlen($contact_message) === 0) {
		header("Location: ../?contact&erreur=1");
		die();
	} else {
		if(!is_string($prenom) || !is_string($nom_de_famille) || !is_string($contact_message)) {
			header("Location: ../?contact&erreur=2");
			die();
		} else {
			if(!filter_var($courriel, FILTER_VALIDATE_EMAIL)) {
				header("Location: ../?contact&erreur=3");
				die();
			} else {
				require '../vendor/autoload.php';
				$mail = new PHPMailer(true);

				try {
					//Server settings
					$mail->SMTPDebug = SMTP::DEBUG_SERVER;
					$mail->isSMTP();
					$mail->Host       = 'smtp.gmail.com';
					$mail->SMTPAuth   = true;
					$mail->Username   = 'melv.douc@gmail.com';
					$mail->Password   = 'wuxugpwysvlsjoox';
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
					$mail->Port       = 587;

					$mail->setFrom("ne-pas-repondre@alpha-betise.fr", "Alpha-Betise");
					// Recipients
					$mail->addAddress($courriel, "$prenom $nom_de_famille");
					$mail->addBCC("melv.douc@gmail.com");
					// $mail->addReplyTo('melv.douc@gmail.com', 'Information');
					// $mail->addCC('cc@example.com');
					// $mail->addBCC('bcc@example.com');

					//Attachments
					// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
					// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

					//Content
					$mail->isHTML(true);
					$mail->Subject = $contact_sujet;
					$apostrophe = ($pseudo != "") ? $pseudo : "$prenom $nom_de_famille";
					$mail->Body = "Bonjour $apostrophe,<br><br>
					Nous avons reçu de votre part le message suivant :<br><br>
					\"$contact_message\"<br><br>
					Nous nous efforcerons de vous répondre dans les meilleurs délais.<br><br>
					Cordialement,<br>
					La Librairie Alpha-Bêtise";
					// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					$mail->CharSet = "UTF-8";
					$mail->send();
					echo "Message envoyé !";
				} catch (Exception $e) {
					echo "Erreur à l'envoi du message. Plus d'infos : {$mail->ErrorInfo}";
				}

				header("Location: ../?confirmation-envoi-message");
				die();
			}
		}
	}
}


else if(isset($_GET["inscription"])) {

	$pseudo = $_POST["pseudo"];
	$courriel = $_POST["courriel"];
	$mdp = $_POST["mdp"];
	$confirmation_mdp = $_POST["confirmation_mdp"];
	$termes = (isset($_POST["termes"]) && $_POST["termes"] === "true") ? true : false;

	if(strlen($pseudo) === 0 || strlen($courriel) === 0 || strlen($mdp) === 0 || strlen($confirmation_mdp) === 0) {
		header("Location: ../?inscription&erreur=1");
		die();
	} else {
		if(!is_string($pseudo) || !is_string($courriel) || !is_string($mdp) || !is_string($confirmation_mdp)) {
			header("Location: ../?inscription&erreur=2");
			die();
		} else {
			if (preg_match('/^[A-Za-z0-9]+(?:[_-][A-Za-z0-9]+)*$/', $pseudo) === 0) {
				header("Location: ../?inscription&erreur=3");
				die();
			} else {
				$req = $bdd->query("SELECT * FROM utilisateurs WHERE pseudo ='$pseudo'")->fetch();
				if ($req != false) {
					header("Location: ../?inscription&erreur=4");
					die();
				} else {
					if (!filter_var($courriel, FILTER_VALIDATE_EMAIL)) {
						header("Location: ../?inscription&erreur=5");
						die();
					} else {
						$req = $bdd->query("SELECT * FROM utilisateurs WHERE adresse_email='$courriel'")->fetch();
						if ($req != false) {
							header("Location: ../?inscription&erreur=6");
							die();
						} else {
							if ($mdp !== $confirmation_mdp) {
								header("Location: ../?inscription&erreur=7");
								die();
							} else {
								$tests_mdp = [
									"majuscules" => preg_match('@[A-Z]@', $mdp),
									"minuscules" => preg_match('@[a-z]@', $mdp),
									"chiffres" => preg_match('@[0-9]@', $mdp),
									"ponctuation" => preg_match('@[^\w]@', $mdp),
									"longueur_min" => strlen($mdp) >= 8,
									"longueur_max" => strlen($mdp) <= 20
								];
		
								$erreurs_mdp = [];
								foreach ($tests_mdp as $clef => $valeur) {
									if($value == false || $valeur === 0) {
										array_push($erreurs_mdp, $clef);
									}
								}
								$total_erreurs = count($erreurs_mdp);
								
								if ($total_erreurs > 0) {
									$types_erreurs = implode("-", $erreurs_mdp);
									header("Location: ../?inscription&erreur=8&types=$types_erreurs");
									die();
								} else {
									if ($terms == false) {
										header("Location: ../?inscription&erreur=9");
										die();
									} else {
										$req = $bdd->prepare("INSERT INTO utilisateurs (adresse_email, pseudo, mot_de_passe, cle_verif, etat_verif, date_creation) VALUES (:adresse_email, :pseudo, :mot_de_passe, :cle_verif, :etat_verif, NOW())");

										$mdp = password_hash($mdp, PASSWORD_DEFAULT);
										$prenom = ucfirst($prenom);
										$nom_de_famille = strtoupper($nom_de_famille);
										$cle_verif = md5(time().$pseudo);
										$etat_verif = 0;

										$req->bindParam(":adresse_email", $courriel, PDO::PARAM_STR);
										$req->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
										$req->bindParam(":mot_de_passe", $mdp, PDO::PARAM_STR);
										$req->bindParam(":cle_verif", $cle_verif, PDO::PARAM_STR);
										$req->bindParam(":etat_verif", $etat_verif, PDO::PARAM_INT);

										$req->execute();

										header("Location: ../?compte-cree");

										//

										require '../vendor/autoload.php';
										$mail = new PHPMailer(true);

										try {
											//Server settings
											$mail->SMTPDebug = SMTP::DEBUG_SERVER;
											$mail->isSMTP();
											$mail->Host       = 'smtp.gmail.com';
											$mail->SMTPAuth   = true;
											$mail->Username   = 'melv.douc@gmail.com';
											$mail->Password   = 'wuxugpwysvlsjoox';
											$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
											$mail->Port       = 587;

											$mail->setFrom("ne-pas-repondre@alpha-betise.fr", "Alpha-Betise");
											$mail->addAddress($courriel, "$pseudo");
											$mail->addBCC("melv.douc@gmail.com");
											// $mail->addReplyTo('melv.douc@gmail.com', 'Information');

											$mail->isHTML(true);
											$mail->Subject = "Vérifiez votre compte";
											$mail->Body = "Bonjour $pseudo,<br><br>
											Veuillez suivre le lien suivant pour valider<br><br>
											http://localhost/appre-projet-dwwm?confirmer-email&cle-verif=$cle_verif<br><br>
											";
											// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

											$mail->CharSet = "UTF-8";
											$mail->send();
											echo "Message envoyé !";
										} catch (Exception $e) {
											echo "Erreur à l'envoi du message. Plus d'infos : {$mail->ErrorInfo}";
										}

										die();
									}
								}
							}
						}
					}
				}
			}
		}
	}
}

else if(isset($_GET["connexion"])) {

	$id_connexion = $_POST["id_connexion"];
	$mdp = $_POST["mdp"];

	if(strlen($id_connexion) === 0 || strlen($mdp) === 0) {
		header("Location: ../?connexion&erreur=1");
		die();
	} else {
		if (!is_string($id_connexion) || !is_string($mdp)) {
			header("Location: ../?connexion&erreur=2");
			die();
		} else {
			$req = $bdd->query("SELECT * FROM utilisateurs WHERE pseudo = '$id_connexion' OR adresse_email = '$id_connexion'")->fetch();
			if($req == false) {
				header("Location: ../?connexion&erreur=3");
				die();
			} else {
				if (!password_verify($mdp, $req["mot_de_passe"])) {
					header("Location: ../?connexion&erreur=3");
					die();
				} else {
					if($req["etat_verif"] != 1) {
						header("Location: ../?connexion&erreur=4");
						die();
					} else {
						$utilisateur = $req["pseudo"];
						$_SESSION["connexion-utilisateur"] = true;
						$_SESSION["utilisateur"] = $utilisateur;
					    $_SESSION["commande"] = [];
						header("Location: ../?profil&utilisateur=$utilisateur");
						die();
					}
				}
			}	
		}
	}
}

else if(isset($_GET["deconnexion"])) {
	unset($_SESSION["connexion-utilisateur"]);
	unset($_SESSION["utilisateur"]);
	header("Location: ../?accueil&connexion=deconnecte");
	die();
}

else if(isset($_GET["reinit-mdp"])) {

	$courriel = $_POST["courriel"];

	if(!filter_var($courriel, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../?reinit-mdp&erreur=1");
		die();
	} else {
		$req = $bdd->query("SELECT * FROM utilisateurs WHERE adresse_email = '$courriel'")->fetch();
		if(!$req) {
			header("Location: ../?reinit-mdp&erreur=2");
			die();
		} else {
			$insert = $bdd->prepare("UPDATE utilisateurs SET cle_mdp = :cle_mdp WHERE adresse_email = '$courriel';");
			$cle_mdp = md5(time().$courriel);
			$insert->bindParam(":cle_mdp", $cle_mdp, PDO::PARAM_STR);
			$insert->execute();
			
			$req = $bdd->query("SELECT * FROM utilisateurs WHERE adresse_email = '$courriel';")->fetch();
			$prenom = $req["prenom"];
			$nom_de_famille = $req["nom_de_famille"];
			$pseudo = $req["pseudo"];

			require '../vendor/autoload.php';
			$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = SMTP::DEBUG_SERVER;
				$mail->isSMTP();
				$mail->Host       = 'smtp.gmail.com';
				$mail->SMTPAuth   = true;
				$mail->Username   = 'melv.douc@gmail.com';
				$mail->Password   = 'wuxugpwysvlsjoox';
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port       = 587;

				$mail->setFrom("ne-pas-repondre@alpha-betise.fr", "Alpha-Betise");
				$mail->addAddress($courriel, "$prenom $nom_de_famille");
				$mail->addBCC("melv.douc@gmail.com");

				$mail->isHTML(true);
				$mail->Subject = "Réinitialiser votre de mot de passe";
				$mail->Body = "Bonjour $pseudo,<br><br>
				Vous avez demandé la réinitialisation de votre mot de passe.<br><br>
				Veuillez suivre le lien suivant pour créer un nouveau mot de passe.<br><br>
				http://localhost/appre-projet-dwwm?creer-nouveau-mot-de-passe&cle_mdp=$cle_mdp<br><br>
				";

				$mail->CharSet = "UTF-8";
				$mail->send();
				echo "Message envoyé !";
			} catch (Exception $e) {
				echo "Erreur à l'envoi du message. Plus d'infos : {$mail->ErrorInfo}";
			}

			header("Location: ../?confirmation-envoi-lien-reinitialisation-mot-de-passe");
			die();
		}
	}

}

else if(isset($_GET["creation-nouveau-mdp"])) {

	$cle_mdp = $_POST["cle_mdp"];
	$mdp = $_POST["mdp"];
	$confirmation_mdp = $_POST["confirmation_mdp"];

	if(strlen($mdp) === 0 || strlen($confirmation_mdp) === 0) {
		header("Location: ../?creer-nouveau-mot-de-passe&cle_mdp=$cle_mdp&erreur=1");
		die();
	} else {
		if($mdp != $confirmation_mdp) {
			header("Location: ../?creer-nouveau-mot-de-passe&cle_mdp=$cle_mdp&erreur=2");
			die();
		} else {
			$tests_mdp = [
				"majuscules" => preg_match('@[A-Z]@', $mdp),
				"minuscules" => preg_match('@[a-z]@', $mdp),
				"chiffres" => preg_match('@[0-9]@', $mdp),
				"ponctuation" => preg_match('@[^\w]@', $mdp),
				"longueur_min" => strlen($mdp) >= 8,
				"longueur_max" => strlen($mdp) <= 20
			];

			$erreurs_mdp = [];
			foreach ($tests_mdp as $clef => $valeur) {
				if($value === false || $valeur === 0) {
					array_push($erreurs_mdp, $clef);
				}
			}
			$total_erreurs = count($erreurs_mdp);
			
			if ($total_erreurs > 0) {
				$types_erreurs = implode("-", $erreurs_mdp);
				header("Location: ../?creer-nouveau-mot-de-passe&cle_mdp=$cle_mdp&erreur=3&types=$types_erreurs");
				die();
			} else {
				$req = $bdd->prepare("UPDATE utilisateurs SET mot_de_passe = :mot_de_passe WHERE cle_mdp = '$cle_mdp'");
				$req->bindParam(":mot_de_passe", password_hash($mdp, PASSWORD_DEFAULT), PDO::PARAM_STR);
				$req->execute();

				header("Location: ../?connexion&reinitialisation-mot-de-passe=succes");
				die();
			}
		}
	}
}

else if(isset($_GET["ajout-panier"])) {
    $id_livre = $_POST["id_livre"];
	array_push($_SESSION["commande"], (INT)$id_livre);
    header("Location: ../?mon-panier");
    die();
}


else if(isset($_GET["modifier-profil"])) {
	$id = (INT)$_GET["id"];
	$pseudo = $_POST["pseudo"];
	$prenom = $_POST["prenom"];
	$nom_de_famille = $_POST["nom_de_famille"];
	$date_de_naissance = $_POST["date_de_naissance"];
	$adresse_postale = $_POST["adresse_postale"];
	$code_postal = $_POST["code_postal"];
	$ville = $_POST["ville"];
	$pays = $_POST["pays"];
	
	// $req = $bdd->query("SELECT pseudo, prenom, nom_de_famille, date_de_naissance, adresse_postale, code_postal, ville, pays FROM utilisateurs WHERE id = $id;")->fetch();
	
	if(strlen($pseudo) > 0 && preg_match('/^[A-Za-z0-9]+(?:[_-][A-Za-z0-9]+)*$/', $pseudo) === 0) {
		echo "pseudo invalide";
		die();
	} else {
		if(strlen($date_de_naissance) > 0 && preg_match('/^(19|20)\d\d\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/', $date_de_naissance) === 0) {
			echo "date de naissance invalide";
			die();
		} else {
			if(strlen($code_postal) > 0 && !is_numeric($code_postal)) {
				echo "code postal invalide";
				die();
			}
		}
	}
}

// else if() {

// }

// else if() {

// }

// else if() {

// }

// else if() {

// }


