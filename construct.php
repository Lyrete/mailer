<?php

require 'database.php';

$db = new DB();

$sql = "SELECT * FROM event ORDER BY startDate";

$wholeresult = $db->getWholeResult($sql);

//initialize arrays for the types of events

$guildEvents = array();
$otherEvents = array();
$misc = array();

$attachments = array();

foreach ($wholeresult as $row){
    if($row["startDate"] > date('Y-m-d')){
        
        $date = date('j.n',strtotime($row["startDate"]));
        
        if ( $row["endDate"] != '0000-00-00' and $row["endDate"] != NULL){
            $date .= '-' . date('j.n',strtotime($row["endDate"]));
        }
        
//        echo $row["kategoria"] . '  -  ' . $date . ' ' . $row["name"] . '  ' .'<br>';
        
        if($row["kategoria"] == "kilta"){
            $element = array();
            $element["title"] = $row["name"] . ' ' . $date;
            $element["event"] = $row["description"];
            array_push($guildEvents, $element);
            if($row["attachment"] != NULL){
                array_push($attachments, $row["attachment"]);
            }
        }
        
        if($row["kategoria"] == "muu"){
            $element = array();
            $element["title"] = $row["name"] . ' ' . $date;
            $element["event"] = $row["description"];
            array_push($otherEvents, $element);
            if($row["attachment"] != NULL){
                array_push($attachments, $row["attachment"]);
            }
        }
        
        if($row["kategoria"] == "ylim"){
            $element = array();
            $element["title"] = $row["name"];
            $element["event"] = $row["description"];
            array_push($misc, $element);
            if($row["attachment"] != NULL){
                array_push($attachments, $row["attachment"]);
            }
        }
        
        
    }
}

$titleHeader = '';
$eventTexts = '';

// construct the header and add the events to the main text
// Header format is rather exact so it is usable as is for TG functionality

$i = 1;

$titleHeader .= '<b>Killan tapahtumat // Guild\'s events</b>' . "\n\n";

foreach ($guildEvents as $event){
    $titleHeader .= $i . '. ' . $event["title"] . "\n";
    $result = $event["event"];
    $eventTexts .= "\n\n<b>" . $i . '. ' . $event["title"]
            . '</b>'. "\n"
            . "\n" .
            $result . "\n\n" . '---------------';    
    $i++;
}

$titleHeader .= "\n" . '<b>Muut tapahtumat // Other events</b>' . "\n\n";

foreach ($otherEvents as $event){
    $titleHeader .= $i . '. ' . $event["title"] . "\n";
    $result = $event["event"];
    $eventTexts .= "\n\n<b>" . $i . '. ' . $event["title"]
            . '</b>'. "\n"
            . "\n" .
            $result . "\n\n" . '---------------';    
    $i++;
}

$titleHeader .= "\n" . '<b>Muuta // Misc.</b>' . "\n\n";

foreach ($misc as $event){
    $titleHeader .= $i . '. ' . $event["title"] . "\n";
    $result = $event["event"];
    $eventTexts .= "\n\n<b>" . $i . '. ' . $event["title"]
            . '</b>'. "\n"
            . "\n" .
            $result . "\n\n" . '---------------';    
    $i++;
}

echo $attachments[0] . $attachments[1] . '<br>';

$mailtext = $_POST["footer"] . "\n--------------\n\n" . $titleHeader . "\n--------------" . $eventTexts;

?>
