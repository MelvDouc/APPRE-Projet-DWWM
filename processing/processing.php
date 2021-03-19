<?php

session_start();
require_once "./db.php";
date_default_timezone_set("Europe/Paris");

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_GET["contact"])) {

	$first_name = $_POST["first-name"];
	$last_name = $_POST["last-name"];
	$email_address = $_POST["email-address"];
	$contact_subject = $_POST["contact-subject"];
	$contact_message = $_POST["contact-message"];

	if(empty($first_name) || empty($last_name) || empty($email_address) || empty($contact_subject) || empty($contact_message)) {
		header("Location: ../?contact");
		die("Veuillez remplir tous les champs.");
	} else {
		if(!is_string($first_name) || !is_string($last_name) || !is_string($contact_message)) {
			header("Location: ../?contact");
			die("Sasie invalide.");
		} else {
			if(!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
				header("Location: ../?contact");
				die("Adresse électronique invalide.");
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
					$mail->addAddress($email_address, "$first_name $last_name");
					$mail->addBCC("melv.douc@gmail.com");
					// $mail->addReplyTo('melv.douc@gmail.com', 'Information');
					// $mail->addCC('cc@example.com');
					// $mail->addBCC('bcc@example.com');

					//Attachments
					// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
					// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

					//Content
					$mail->isHTML(true);
					$mail->Subject = $contact_subject;
					$mail->Body = "Bonjour $first_name $last_name,<br><br>
					Nous avons reçu de votre part le message suivant :<br><br>
					\"$contact_message\"<br><br>
					Nous nous efforcerons de vous répondre dans les meilleurs délais.<br><br>
					Cordialement,<br>
					La Librairie Alpha-Bêtise
					";
					// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					$mail->CharSet = "UTF-8";
					$mail->send();
					echo "Message envoyé !";
				} catch (Exception $e) {
					echo "Erreur à l'envoi du message. Plus d'infos : {$mail->ErrorInfo}";
				}

				header("Location: ../");
				die();
			}
		}
	}
}


else if(isset($_GET["register"])) {

	$first_name = $_POST["first-name"];
	$last_name = $_POST["last-name"];
	$username = $_POST["username"];
	$email_address = $_POST["email-address"];
	$pwd = $_POST["pwd"];
	$confirm_pwd = $_POST["confirm-pwd"];
	$terms = (isset($_POST["terms"]) && $_POST["terms"] === "true") ? true : false;

	if(empty($first_name) || empty($last_name) || empty($username) || empty($email_address) || empty($pwd) || empty($confirm_pwd)) {
		header("Location: ../?inscription&error=1");
		die();
	} else {
		if(!is_string($first_name) || !is_string($last_name) || !is_string($username) || !is_string($email_address) || !is_string($pwd) || !is_string($confirm_pwd)) {
			header("Location: ../?inscription&error=2");
			die();
		} else {
			if (preg_match('/\s/', $username) === 1) {
				header("Location: ../?inscription&error=3");
				die();
			} else {
				$req = $db->query("SELECT * FROM utilisateurs WHERE pseudo ='$username'")->fetch();
				if ($req != false) {
					header("Location: ../?inscription&error=4");
					die();
				} else {
					if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
						header("Location: ../?inscription&error=5");
						die();
					} else {
						$req = $db->query("SELECT * FROM utilisateurs WHERE adresse_email='$email_address'")->fetch();
						if ($req != false) {
							header("Location: ../?inscription&error=6");
							die();
						} else {
							if ($pwd !== $confirm_pwd) {
								header("Location: ../?inscription&error=7");
								die();
							} else {
								$pwd_tests = [
									"uppercase" => preg_match('@[A-Z]@', $pwd),
									"lowercase" => preg_match('@[a-z]@', $pwd),
									"number" => preg_match('@[0-9]@', $pwd),
									"punctuation" => preg_match('@[^\w]@', $pwd),
									"min_length" => strlen($pwd) >= 8,
									"max_length" => strlen($pwd) <= 20
								];
		
								$pwd_errors = [];
								foreach ($pwd_tests as $key => $value) {
									if($value === false || $value === 0) {
										array_push($pwd_errors, $key);
									}
								}
								$error_count = count($pwd_errors);
								
								if ($error_count > 0) {
									$error_types = implode("-", $pwd_errors);
									header("Location: ../?inscription&error=8&errortypes=$error_types");
									die();
								} else {
									if ($terms === false) {
										header("Location: ../?inscription&error=9");
										die();
									} else {
										$req = $db->prepare("INSERT INTO utilisateurs (adresse_email, pseudo, mot_de_passe, prenom, nom_de_famille, cle_verif, etat_verif, date_creation) VALUES (:adresse_email, :pseudo, :mot_de_passe, :prenom, :nom_de_famille, :cle_verif, :etat_verif, NOW())");

										$pwd = password_hash($pwd, PASSWORD_DEFAULT);
										$first_name = ucfirst($first_name);
										$last_name = strtoupper($last_name);
										$cle_verif = md5(time().$username);
										$etat_verif = 0;

										$req->bindParam(":adresse_email", $email_address, PDO::PARAM_STR);
										$req->bindParam(":pseudo", $username, PDO::PARAM_STR);
										$req->bindParam(":mot_de_passe", $pwd, PDO::PARAM_STR);
										$req->bindParam(":prenom", $first_name, PDO::PARAM_STR);
										$req->bindParam(":nom_de_famille", $last_name, PDO::PARAM_STR);
										$req->bindParam(":cle_verif", $cle_verif, PDO::PARAM_STR);
										$req->bindParam(":etat_verif", $etat_verif, PDO::PARAM_INT);

										$req->execute();

										header("Location: ../");

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
											$mail->addAddress($email_address, "$first_name $last_name");
											$mail->addBCC("melv.douc@gmail.com");
											// $mail->addReplyTo('melv.douc@gmail.com', 'Information');

											$mail->isHTML(true);
											$mail->Subject = "Vérifiez votre compte";
											$mail->Body = "Bonjour $username,<br><br>
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

// else if() {

// }

// else if() {

// }

// else if() {

// }


