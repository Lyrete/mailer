<?php

require 'database.php';

session_start();

if($_SESSION["user"] != NULL){
    
    include 'navigation.php';
    
    //Fetch current week's newsletter header
        
    $week = (int)date('W', strtotime('today'));
    $filename = 'WNL/wnl_' . $week . '.html';    
    $wholecontents = file_get_contents($filename);
    
    $array = explode('--------------', $wholecontents);
    
    //HAVE TO MAKE A CHECK FOR THE GUILD NEWS THING NEXT WEEK
    
    $headerFromFile = rtrim($array[1]);
    
    $breaks = array("<br />","<br>","<br/>");
    
    $finalContent = str_ireplace($breaks, "\n", $headerFromFile);
    $finalContent = str_ireplace("\n\n", "\n", $finalContent);
        
    $db = new DB();
    
    $sql = 'SELECT * FROM TGchannels';
    
    $options = $db->getWholeResult($sql);
    
    ?>

<form action="TGmsg.php" method="post">
    <input type="submit" name="foo" value="send"></button>
</form>

<?php

if(isset($_POST["foo"])){
    
    //make channel list

    $channels = array();
    
    foreach($options as $a){
        array_push($channels, $a["channel"]);
    }
    
    $api_token = $db->getBotApi();
    $method = "/sendMessage";
    $url = "https://api.telegram.org/bot";

    //add options to url
    
    $header = '<b>' . 'Lue koko tiedote tästä: </b>Lyrete.me/WNLread.php'; 
    
    $text = $header . "" . $finalContent . "" . $header;

    $urlStart = $url . $api_token . $method . '?chat_id=';
    
    $i = 0;
    
    foreach($channels as $channel){
        
        $url = $urlStart .  $channel . '&parse_mode=HTML' . '&text=';
        
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
        
        $i += 1;
    }
    
    echo 'Messages sent to ' . $i . ' channels!';
    
}
//    
} else {
    include 'index.php';
    
}

?>