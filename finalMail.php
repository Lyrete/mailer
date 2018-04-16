<?php

include 'database.php';

session_start();

if($_SESSION["user"] != NULL){
    
    include 'navigation.php';
    
    $db = new DB();
?>


<form action="finalMail.php" method="post" enctype="multipart/form-data">
    Sender: <input type="text" name="sender"><br>
    Receiver: <input type="text" name="receiver"><br>
    Subject: <input style="width:400px" type="text" name="subject"><br>
    When to send: <input type="time" name="timeToSend" id="timeToSend"><br>
    Which week to construct for: <select name="week">
    <?php
            for ( $i == 1; $i <= date('W',strtotime('December 24')) ; $i += 1 ){
                echo '<option value="';
                echo $i;
                if($i == (int)date('W', strtotime('today'))){
                    echo '" selected>';
                } else {
                    echo '">';
                }
                echo $i;
                echo '</option>';
            }    
    ?>
    </select>

    <br>

    Footer: <textarea name="footer" rows="25" cols="200"></textarea><br>
    
    
    <input type="submit">
</form>

<?php

if(isset($_POST["sender"])==TRUE){
    
    include 'construct.php';
       
    $filename = 'WNL/wnl_' . $_POST["week"] . '.html';
    
    $file = fopen($filename, 'w');
    
    chmod($filename, 0775);
    
    fwrite($file, nl2br($mailtext));
    
    fclose($file);
    
    $zippath = 'WNL/attachments/WNL' . $_POST["week"] . '.zip';  
    
//    echo $zippath;
//    
//    $zip = new ZipArchive();
//       
//    if ($zip->open($zippath, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE) === TRUE){
//        echo 'are we here?';
//        // Add files to the zip file
//        for($i=0; $i < sizeof($attachments); $i++){ 
//            echo 'this too?';
//            $zip->addFile(substr($attachments[$i],1), substr($attachments[$i],13));         // Add attachments to zip            
//        }      
//        // All files are added, so close the zip file.
//        $zip->close();
//    }
//    
//    chmod($zippath, 0775);
    
    echo $db->addFullLetter($mailtext, $week, $filename, $zippath);
    
    include 'mailit.php';
}

} else {
    include 'index.php';
}


