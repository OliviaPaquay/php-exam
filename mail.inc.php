<?php
require 'PHPMailer-master/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mandrillapp.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'alexandre@pixeline.be';                 // SMTP username
$mail->Password = 'bDMUEuWn1H4r3FCGQjyO-g';                           // SMTP password
$mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('olivia.paquay@gmail.com');
$mail->addAddress($email);     // Add a recipient

$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$href = 'localhost:8888/php-exam/confirm.php?id='. $uniqid;

$mail->Subject = 'Confirmation d\'inscription';
$mail->Body    = '<a href="http://localhost:8888/php-exam/confirm.php?id='. $uniqid. '">clik</a>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    die('Merci, vous allez recevoir un email de confirmation');
}