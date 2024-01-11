<?php

ini_set("SMTP", "smtp.gmail.com");
ini_set("smtp_port", 465);
ini_set("sendmail_from", "gaetano.mosca13@gmail.com");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php'; // Assicurati di includere la libreria PHPMailer

$mail = new PHPMailer(true);

try {
    // Configura il server SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'tuaindirizzo@gmail.com'; // Sostituisci con il tuo indirizzo email Gmail
    $mail->Password   = 'tuo_password'; // Sostituisci con la tua password Gmail o token OAuth
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    // Altri settaggi del messaggio
    $mail->setFrom('tuaindirizzo@gmail.com', 'Il tuo nome');
    $mail->addAddress('gaetano.mosca13@gmail.com');
    $mail->Subject = 'Oggetto del messaggio';
    $mail->Body    = 'Corpo del messaggio';

    // Invia il messaggio
    $mail->send();
    echo 'Messaggio inviato con successo';
} catch (Exception $e) {
    echo "Errore nell'invio del messaggio: {$mail->ErrorInfo}";
}

?>

