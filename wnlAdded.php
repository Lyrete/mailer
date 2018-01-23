<?php

require 'Event.php';
require 'values.php';

$text = $_POST["text"];

$finalText = '';

//POST dates from wnlAdd.php
//and conversion to Date objects for easy comparing

$start = $_POST["startDate"];
$end = $_POST["endDate"];

$eventType = $_POST["eventType"];

session_start();

for ($i = 0; $i < strlen($text); $i++){
    
    if($text[$i] == "'"){                                // adds a \ before ' symbols because of problems otherwise
        $finalText .= "\'";                               
    } else {
        $finalText .= $text[$i];
    }
}

$finalEvent = '';

for ($i = 0; $i < strlen($_POST["subject"]); $i++){
    
    if($_POST["subject"][$i] == "'"){                                // adds a \ before ' symbols because of problems otherwise
        $finalEvent .= "\'";                               
    } else {
        $finalEvent .= $_POST["subject"][$i];
    }
}

$sqlstring = "INSERT INTO event (name, startDate, endDate, description, kategoria)"
        . " VALUES ('" . $finalEvent . "','" . $start . "','" . $end . "','" .
        $finalText . "','" . $eventType . "')";

$conn = mysqli_connect('localhost', $_SESSION["dbUser"], $_SESSION["dbPW"],'newsletter');
$conn->set_charset('utf8');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully<br>";

$result = $conn->query($sqlstring);

echo $result;



////TG message functionality
//
//$channel = "-1001398336786";
//$api_token = $values->api_key;
//$method = "/sendMessage";
//$url = "https://api.telegram.org/bot";
//
////add options to url
//
//$url = $url . $api_token . $method . '?chat_id=' . $channel . '&parse_mode=HTML' . '&text=';
//
//if(strlen($text) > 4096){
//    $arr1 = str_split($text, 4096);
//    foreach($arr1 as $part){
//        $ch = curl_init($url . urlencode($part));
//        curl_exec($ch);
//    }
//} else {
//    $ch = curl_init($url . urlencode($text));
//    curl_exec($ch);
//}        
//
//?>



<form action="wnlAdd.php" method="post">
    Added.<br>
<input type="submit" value="Back">

