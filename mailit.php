<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'values.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mail = new \PHPMailer\PHPMailer\PHPMailer();
$values = new Values();

try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $values->smtp;                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $values->user;                 // SMTP username
    $mail->Password = $values->pw;                        // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->CharSet = 'utf-8';

    //Recipients
    $mail->setFrom($_POST["sender"], 'Tommi Alajoki');
    $mail->addAddress($_POST["receiver"]);     // Add a recipient
//    $mail->addAddress('ellen@example.com');               // Name is optional
//    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC($values->bcc);

    //Attachments
    for($i=0; $i < sizeof($attachments); $i++){    
        try{
            $mail->addAttachment(__DIR__ . $attachments[$i]);         // Add attachments
        }catch (Exception $e){
            echo 'No attachment added.';
        }
    }

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = ($_POST["subject"]);
    $mail->Body    = nl2br($mailtext);
    $mail->AltBody = $mailtext;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}