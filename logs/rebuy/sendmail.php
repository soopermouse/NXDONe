<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 12/10/2018
 * Time: 06:04
 */



$email = $_REQUEST['email'] ;
$name = $_REQUEST['name'] ;
$phone = $_REQUEST['phone'] ;
$message = $_REQUEST['message'] ;
require("phpmailer/PHPMailerAutoload.php");

$mail = new PHPMailer();

$mail->IsSMTP();

$mail->Host = "smtp.gmail.com";

$mail->SMTPAuth = true;

$mail->Username = "yoursmtp@username.com"; // SMTP username
$mail->Password = "hidden"; // SMTP password
$mail->addAttachment("uploads/".$file_name);
$mail->From = $email;
$mail->SMTPSecure = 'tls';
$mail->Port = 587; //SMTP port
$mail->addAddress("your@email.com", "your name");
$mail->Subject = "You have an email from a website visitor!";
$mail->Body ="
Name: $name<br>
Email: $email<br>
Telephone: $phone<br><br><br>
Comments: $message";
$mail->AltBody = $message;

if(!$mail->Send())
{
    echo "Message could not be sent. <p>";
    echo "Mailer Error: " . $mail->ErrorInfo;
    exit;
}

echo "<script>alert('Message has been sent')</script>";
?>