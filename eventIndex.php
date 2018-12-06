<?php
include_once "userPDO.php";
session_start();

if($_SESSION["user"] != NULL){

    include 'navigation.php';
    $db = new DB();
    include_once 'eventFetcher.php';

    $eventFetcher = new eventFetcher();

    $events = $eventFetcher->getAllEvents("date");

    ?>

  <table>
    <tr>
      <th>StartDate</th>
      <th>Name</th>
    </tr>

    <?php

    foreach ($events as $event){
        echo "<tr><td>";
        echo $event->getStartDate() . "</td><td>";
        echo $event->getName();
        echo "</td></tr>";
    }

    ?>

  </table>



<?php

} else {
    include 'index.php';
} ?>
