<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 02/03/2019
 * Time: 16:27
 */

namespace App\Helpers;
use PHPMailer\PHPMailer\PHPMailer;

class mail
{
        public static function sendmail($name,$email,$subject,$order_id,$quote)
        {
            /*$name=$_POST['name'];
            $email=$_POST['email'];
            $subject="Offer from Forza";
            $quote=$_POST['msg'];*/
            $body="Thank you for sending us your device. 
                We would like to offer you \r\n $quote \r\n euro for it". 'To accept or refuse please visit <a href='.'"'.'http://forzaerp.local/rebuy/'.$order_id.'/'.'acceptquote'.'"'.'>This Link</a>';
            echo '<pre>';
            var_dump($_POST);

            $mail = new PHPMailer(TRUE);

            try {

                $mail->setFrom('simona.thrussell@forza-refurbished.nl', $name);
                $mail->addAddress($email, 'your name');
                $mail->Subject = $subject;
                $mail->Body = $body;

                /* SMTP parameters. */
                $mail->isSMTP();
                $mail->Host = 'smtp.office365.com';
                $mail->SMTPAuth = TRUE;
                $mail->SMTPSecure = 'tls';
                $mail->Username = 'simona.thrussell@forza-refurbished.nl';
                $mail->Password = 'DcadkA7h';
                $mail->Port = 587;

                /* Disable some SSL checks. */
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                /* Finally send the mail. */
                $mail->send();
                $message="mail was sent";
                return $message;

            }
            catch (Exception $e)
            {
                echo $e->errorMessage();
            }
        }

        public static function sendsecondoffer($name,$email,$subject,$order_id,$quote)
        {
            /*$name=$_POST['name'];
            $email=$_POST['email'];
            $subject="Offer from Forza";
            $quote=$_POST['msg'];*/
            $body="Thank you for sending us your device. 
                We would like to offer you \r\n $quote \r\n euro for it". 'To accept or refuse please visit <a href='.'"'.'http://forzaerp.local/rebuy/'.$order_id.'/'.'acceptsecquote'.'"'.'>This Link</a>';
            echo '<pre>';
            var_dump($_POST);

            $mail = new PHPMailer(TRUE);

            try {

                $mail->setFrom('simona.thrussell@forza-refurbished.nl', $name);
                $mail->addAddress($email, 'your name');
                $mail->Subject = $subject;
                $mail->Body = $body;

                /* SMTP parameters. */
                $mail->isSMTP();
                $mail->Host = 'smtp.office365.com';
                $mail->SMTPAuth = TRUE;
                $mail->SMTPSecure = 'tls';
                $mail->Username = 'simona.thrussell@forza-refurbished.nl';
                $mail->Password = 'DcadkA7h';
                $mail->Port = 587;

                /* Disable some SSL checks. */
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                /* Finally send the mail. */
                $mail->send();
                $message="mail was sent";
                return $message;

            }
            catch (Exception $e)
            {
                echo $e->errorMessage();
            }
        }
}