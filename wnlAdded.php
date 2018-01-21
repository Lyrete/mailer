<?php

require 'Event.php';
require 'values.php';

$text = $_POST["text"];

$finalText = '';

//POST dates from wnlAdd.php
//and conversion to Date objects for easy comparing

$start = $_POST["startDate"];
$end = $_POST["endDate"];

$day = substr($start, 8, 2);
$month = substr($start, 5, 2);

$startDate = new Date($day, $month);

$day = substr($end, 8, 2);
$month = substr($end, 5, 2);

$endDate = new Date($day, $month);

$event = new Event($_POST["subject"], $startDate, $endDate, $text);

$week = strftime('%V',time());

mkdir(__DIR__ . '/data/' . $week . '/', 0777);
chmod(__DIR__ . '/data/' . $week . '/', 0777);

$rawFile = fopen(__DIR__ . '/data/' . $week . '/test.txt', 'w');
//$htmlFile = fopen('data/test.html', 'w');
fwrite($rawFile, serialize($event));
//fwrite($htmlFile, $event->HTMLtext());
fclose($rawFile);
//fclose($htmlFile);
        

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

