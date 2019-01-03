<?php

include_once "userPDO.php";
session_start();

if($_SESSION["user"] != NULL){

    include 'navigation.php';
    $db = new DB();
    $user = $_SESSION['user'];
    include_once 'eventFetcher.php';

    $userPDO = new UserPDO();
    $eventFetcher = new eventFetcher();

    $event = $eventFetcher->getEvent($_GET["id"]);

    $eventFetcher->deleteEvent($event->getId());

    echo "Removed the event " . $event->getName();

} else {
    include 'index.php';
} ?>
