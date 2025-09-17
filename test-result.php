<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';             
    $mail->SMTPAuth = true;
    $mail->Username = 'harnarf581@gmail.com';           
    $mail->Password = 'nddz mdvo efvf jucu';              
    $mail->SMTPSecure = 'ssl';                
    $mail->Port = 465;                         

    $mail->setFrom('harnarf581@gmail.com', 'Test Sender');
    $mail->addAddress('harnarf581@gmail.com');   

    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = 'This is a test email from PHPMailer.';

    $mail->SMTPDebug = 2;
    $mail->send();
    echo 'Email sent successfully';
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
