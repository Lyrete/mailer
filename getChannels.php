<style><?php include 'styles.css'?></style>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



include 'database.php';

$db = new DB();

$api_token = $db->getBotApi();
$method = "/getUpdates";
$url = "https://api.telegram.org/bot";

//add options to url

$url = $url . $api_token . $method . '?offset=184451479';

echo $url . '<br><br>';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);

$arrayString = substr($result,21, -2);

echo $arrayString . '<br><br>';

$test = str_ireplace("},{", '}splitstrhere{', $arrayString);

//echo $test . '<br><br>';

$array = explode('splitstrhere',$test);

foreach($array as $a){
    echo $a . '<br><br>';
}



