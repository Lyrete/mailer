<?php

$text = $_POST["text"];

$finalText = '';

for ($i = 0; $i < strlen($text); $i++){
    
    if($text[$i] == "\n"){                                // Replaces newline chars with html breaks
        $finalText .= '<br>';                               
    } else {
        $finalText .= $text[$i];
    }
}

//$textForBot = [];
//
//if(strlen($text) > 4096){
//    $counter = strlen($text);
//    for($i = 0; $counter > 4096; $counter - 4096){
//        $textForBot[$i] = substr($text, $i * 4096, $i * 4096 + 4096);  
//    }
//    $textForBot[$i] = substr($text, $i * 4096);
//} else {
//    $textForBot[$i] = $text;
//}



$channel = "-1001398336786";
$api_token = "416904756:AAGGqOLio1vAS2KpbqqMKiZKmFk_pJVm3nU";
$method = "/sendMessage";
$url = "https://api.telegram.org/bot";

//add options to url

$url = $url . $api_token . $method . '?chat_id=' . $channel . '&text=';

if(strlen($text) > 4096){
    $arr1 = str_split($text, 4096);
    foreach($arr1 as $part){
        $ch = curl_init($url . $part);
        curl_exec($ch);
    }
} else {
    echo $text;
    echo $url . $text;
    $ch = curl_init($url . $text);
    curl_exec($ch);
}
        

//?chat_id=-1001398336786&text=test
        

?>



<form action="wnlAdd.php" method="post">
    Added.<br>
<input type="submit" value="Back">

