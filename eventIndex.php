<?php
include_once "userPDO.php";
session_start();

if($_SESSION["user"] != NULL){

    include 'navigation.php';
    include_once 'eventPDO.php';

    $eventPDO = new eventPDO();

    $events = $eventPDO->getAllEvents("date");

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
        echo "<a href='eventManager.php?id=" . $event->getId() . "'>";
        echo $event->getName() . "</a>";
        echo "</td></tr>";
    }

    ?>

  </table>



<?php

} else {
    include 'index.php';
} ?>
