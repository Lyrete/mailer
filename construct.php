<?php

session_start();

$conn = mysqli_connect('localhost', $_SESSION["dbUser"], $_SESSION["dbPW"],'newsletter');
$conn->set_charset('utf8');

$sql = "SELECT * FROM event";

$result = $conn->query($sql);

$wholeresult = mysqli_fetch_all($result,MYSQLI_ASSOC);

$date = array();

foreach ($wholeresult as $key => $row)
{
    $date[$key] = $row['startDate'];
}
array_multisort($date, SORT_ASC, $wholeresult);

$type = array();

foreach ($wholeresult as $key => $row)
{
    $type[$key] = $row['kategoria'];
}
array_multisort($type, SORT_ASC, $wholeresult);

//initialize arrays for the types of events

$guildEvents = array();
$otherEvents = array();
$misc = array();

foreach ($wholeresult as $row){
    if($row["startDate"] > date('Y-m-d')){
        
        $date = date('j.n',strtotime($row["startDate"]));
        
        if ( $row["endDate"] != '0000-00-00' and $row["endDate"] != NULL){
            $date .= '-' . date('j.n',strtotime($row["endDate"]));
        }
        
//        echo $row["kategoria"] . '  -  ' . $date . ' ' . $row["name"] . '  ' .'<br>';
        
        if($row["kategoria"] == "kilta"){
            $guildEvents["title"] = $row["name"] . ' ' . $date;
            $guildEvents["event"] = $row["description"];
        }
        
        if($row["kategoria"] == "muu"){
            array_push($otherEvents, $row["name"] . ' ' . $date);
        }
        
        if($row["kategoria"] == "ylim"){
            array_push($misc, $row["name"]);
        }
        
        
    }
}


$titleHeader = '';
$eventTexts = '';

// construct the header and add the events to the main text

$i = 1;

$titleHeader .= '<b>Killan tapahtumat // Guild\'s events</b>' . '<br><br>';

foreach ($guildEvents as $event){
    $titleHeader .= $i . '. ' . $event["title"] . '<br>';
    $eventTexts .= '<br><br><b>' . $i . '. ' . $title . '</b>'. '<br>'
            . '<br>' .
            $event["event"] . '<br><br>' . '---------------';    
    $i++;
}

$titleHeader .= '<br>' . '<b>Muut tapahtumat // Other events</b>' . '<br><br>';

foreach ($otherEvents as $title){
    $titleHeader .= $i . '. ' . $title . '<br>';
    $i++;
}

$titleHeader .= '<br>' . '<b>Muuta // Misc.</b>' . '<br><br>';

foreach ($misc as $title){
    $titleHeader .= $i . '. ' . $title . '<br>';
    $i++;
}



echo $titleHeader;
echo $eventTexts;

?>
