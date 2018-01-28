<?php

require 'database.php';

session_start();

if($_SESSION["user"] != NULL){
    
    include 'navigation.php';
    
    //TG message functionality
        
    include 'construct.php';
    
    echo nl2br($titleHeader);
    
    $db = new DB();
    
    $sql = 'SELECT * FROM TGchannels';
    
    $options = $db->getWholeResult($sql);
    
    ?>

<form action="TGmsg.php" method="post">
    <select name="channel">
        <?php
            foreach($options as $option){
                echo '<option value="';
                echo $option["channel"];
                echo '">';
                echo $option["selecterName"];
                echo '</option>';
            }
        ?>
    </select>
    <input type="submit">
</form>

<?php

if(isset($_POST["channel"])){

    $channel = $_POST["channel"];
    $api_token = $db->getBotApi();
    $method = "/sendMessage";
    $url = "https://api.telegram.org/bot";

    //add options to url
    
    $header = '<b>' . 'Lue koko tiedote tästä: </b>Lyrete.me/WNLread.php'; 
    
    $text = $header . "\n\n" . $titleHeader . "\n" . $header;

    $url = $url . $api_token . $method . '?chat_id=' . $channel . '&parse_mode=HTML' . '&text=';

    if(strlen($text) > 4096){
        $arr1 = str_split($text, 4096);
        foreach($arr1 as $part){
            $ch = curl_init($url . urlencode($part));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
        }
    } else {
        $ch = curl_init($url . urlencode($text));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
    }
    
    echo 'Message sent!';
    
}
//    
} else {
    include 'index.php';
    
}

?>