<?php
require 'PHPMailerAutoload.php';

    $fields = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'message' => $_POST['message']
    ];

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'localhost';  // Specify main and backup SMTP servers                               // Enable SMTP authentication
$mail->Username = '';                 // SMTP username
$mail->Password = '';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->FromName = '';
$mail->addAddress('', '');     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'You have a message sent from your site.';
$mail->Body    = 'From: ' . $fields['name'] . ' (' . $fields['email'] .')<p>' . $fields['message'] . '</p>';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>