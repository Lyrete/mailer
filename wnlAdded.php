<?php

require 'Date.php';

$text = $_POST["text"];

$finalText = '';

for ($i = 0; $i < strlen($text); $i++){
    
    if($text[$i] == "\n"){                                // Replaces newline chars with html breaks
        $finalText .= '<br>';                               
    } else {
        $finalText .= $text[$i];
    }
}

$start = $_POST["startDate"];
$end = $_POST["endDate"];

$day = substr($start, 8, 2);
$month = substr($start, 5, 2);

$startDate = new Date($day, $month);

$day = substr($end, 8, 2);
$month = substr($end, 5, 2);

$endDate = new Date($day, $month);

if($endDate->day == '' and $endDate->month == ''){
    $duration = (string)$startDate;
} else {
    $duration = $startDate . '-' . $endDate;
}

$subject = $_POST["subject"] . ' ' . $duration;

$text = '<b>' . $subject . '</b>' . "\n" . "\n" . $text;

//TG message functionality

$channel = "-1001398336786";
$api_token = "416904756:AAGGqOLio1vAS2KpbqqMKiZKmFk_pJVm3nU";
$method = "/sendMessage";
$url = "https://api.telegram.org/bot";

//add options to url

$url = $url . $api_token . $method . '?chat_id=' . $channel . '&parse_mode=HTML' . '&text=';

if(strlen($text) > 4096){
    $arr1 = str_split($text, 4096);
    foreach($arr1 as $part){
        $ch = curl_init($url . urlencode($part));
        curl_exec($ch);
    }
} else {
    $ch = curl_init($url . urlencode($text));
    curl_exec($ch);
}
        

//?chat_id=-1001398336786&text=test
        

?>



<form action="wnlAdd.php" method="post">
    Added.<br>
<input type="submit" value="Back">

