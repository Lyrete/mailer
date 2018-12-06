<?php
include_once "userPDO.php";
session_start();

if($_SESSION["user"] != NULL){

    include 'navigation.php';
    $db = new DB();
    include_once 'eventFetcher.php';

    $eventFetcher = new eventFetcher();

    $events = $eventFetcher->getAllEvents();

    foreach ($events as $event){
        echo $event->getName() . "<br>";
    }

?>

<?php

} else {
    include 'index.php';
} ?>
