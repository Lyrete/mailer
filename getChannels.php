<style><?php include 'styles.css'?></style>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



include_once 'database.php';

$db = new DB();

$api_token = $db->getBotApi();
$method = "/getUpdates";
$urlStart = "https://api.telegram.org/bot";

//add options to url

$urlStart .= $api_token; 
$url = $urlStart . $method . '?offset=-20';

echo $url . '<br><br>';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);

//echo $result . '<br><br>';
$jsonObject = json_decode($result);
$array = $jsonObject->result;

foreach($array as $a){
    $channel = $a->message->chat->id;
    $name = $a->message->chat->title;
    if($db->insertIfNotIn($channel, $name)){
        //If channel wasn't in db send welcome msg.
        $message = "Added to database!\nWelcome!";
        $method = '/sendMessage';
        $url = $urlStart . $method . '?chat_id=' . $channel . '&text=' . urlencode($message);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
    }else{
    }
    
    echo '<br>';   
    
}
