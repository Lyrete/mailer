<?php

include_once "userPDO.php";
session_start();

if($_SESSION["user"] != NULL){

    include 'navigation.php';
    $db = new DB();
    $user = $_SESSION['user'];
    include_once 'eventPDO.php';

    $userPDO = new UserPDO();
    $eventPDO = new eventPDO();

    $event = $eventPDO->getEvent($_GET["id"]);

    $eventPDO->deleteEvent($event->getId());

    echo "Removed the event " . $event->getName();

} else {
    include 'index.php';
} ?>
