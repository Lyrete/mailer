<?php
include_once 'userPDO.php';
session_start();



if($_SESSION["user"] != NULL){

    include 'navigation.php';

    $db = new DB();


require_once 'Event0.php';
//require 'values.php';
require_once 'database.php';
require_once 'eventFetcher.php';

$eventFetcher = new eventFetcher();

$text = $_POST["text"];

$finalText = '';

//POST dates from wnlAdd.php
//and conversion to Date objects for easy comparing
$start = $_POST["startDate"];
if($_POST["endDate"] > 0){
    $end = $_POST["endDate"];
}else{
    $end = NULL;
}

$eventType = $_POST["eventType"];

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

$event = new Event();
$event->setKategoria($eventType);
$event->setStartDate($start);
$event->setEndDate($end);
$event->setDescription($_POST["event"]);
$event->setName($_POST["subject"]);

$eventFetcher->addEvent($event);

//INSERT INTO event (name, startDate,

// $sqlstring = "INSERT INTO event (name, startDate)";
//
// $sqlstring .= "description, kategoria)" . " VALUES ('" . $finalEvent . "','" . $start . "',";
//
// if(!($end == '')){
//     $sqlstring .= "'" . $end . "',";
// }
//
//
// $sqlstring .= "'" . $finalText . "','" . $eventType . "')";
//
// $db = new DB();
// $db->query($sqlstring);


?>



<form action="wnlAdd.php" method="post">
    Added.<br>
    <input type="submit" value="Back"></form>

<?php

}else{
  include "index.php";
}

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
//
