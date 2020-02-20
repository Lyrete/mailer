<?php
include_once 'userPDO.php';
session_start();



if($_SESSION["user"] != NULL){

    include 'navigation.php';

    $db = new DB();


require_once 'Event.php';
//require 'values.php';
require_once 'database.php';
require_once 'eventPDO.php';

$eventPDO = new eventPDO();

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

$showDate = 0;
if(!empty($_POST["showDate"])){
    $showDate = 1;
}

$event = new Event();
$event->setKategoria($eventType);
$event->setStartDate($start);
$event->setShowDate($showDate);
$event->setEndDate($end);
$event->setDescription($_POST["text"]);
$event->setName($_POST["subject"]);



$name = $_FILES['fileToUpload']['name'];
$temp_name = $_FILES['fileToUpload']['tmp_name'];

if (isset($name)) {

    if (!empty($name)) {
        $location = './attachments/';
        if (move_uploaded_file($temp_name, $location.$name)) {
            echo 'Uploaded file ' . $name . " with id ";
            $event->setAttachment('/attachments/' . $name);
        }
    }    

} else {
    echo 'Upload failed.';
    $event->setAttachment(NULL);
}

$eventPDO->addEvent($event);


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
