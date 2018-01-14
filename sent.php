<?php

ini_set('max_execution_time', 23600);
ini_set('file_uploads', 'On');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'values.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function upload($filename){
    $target_dir = __DIR__ . "/uploads/";
    $target_file = $target_dir . basename($_FILES[$filename]["name"]);
    $uploadOk = 1;
    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$filename]["tmp_name"], $target_file)) {
            echo "The file ". basename($_FILES[$filename]["name"]). " has been uploaded.";
            return $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }    
    }   
}

$mail = new PHPMailer(true);
$values = new Values(); // I should probably make these inputtable instead of static

$text = $_POST["text"];


$finalText = '';

for ($i = 0; $i < strlen($text); $i++){
    
    if($text[$i] == "\n"){                                // Replaces newline chars with html breaks
        $finalText .= '<br>';                               // for mailing as HTML
    } else {
        $finalText .= $text[$i];
    }
}

$finalText .= $values->signature; //adds signature to the end



//while(true){
//    if(microtime(true) > 1515384000){        
//        break;
//    }
//}

$attachments = [];

for ($i=1; $i <= 2; $i++){
    $name = "fileToUpload" . $i;
    $attachments[] = upload($name);
}

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
        $mail->addAttachment($attachments[$i]);         // Add attachments
    }

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = ($_POST["subject"]);
    $mail->Body    = $finalText;
    $mail->AltBody = $text;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}



?>

<form action="index.php" method="post">
    <input type="submit" name="Back" value="Back" />
</form>



