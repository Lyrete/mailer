<?php
include_once "userPDO.php";
session_start();

if($_SESSION["user"] != NULL){

    include 'navigation.php';
    include_once 'eventPDO.php';

    $eventPDO = new eventPDO();

    $event = $eventPDO->getEvent($_GET["id"]);

    $types = array("atiedotus","kilta", "muu", "ylim");

    ?>

    <form method="post" action="deleteEvent.php?id=<?php echo $event->getId() ?>" onsubmit="return confirm('Are you sure you want to delete the event?');">
      <input type=submit value="Delete the Event">
    </form>

    <form method="post" action="<?php $eventPDO->updateEvent($event) ?>">
      <input type=hidden name="id" value="<?php echo $event->getId() ?>">
      <table>
      <tr>
        <td>Nimi</td>
        <td><input type=text name="name" value="<?php echo $event->getName()?>"></td>
      </tr>
      <tr>
        <td>Start Date</td>
        <td><input type=Date name="startDate" value="<?php echo $event->getStartDate() ?>"></td>
      </tr>
      <tr>
        <td>End Date</td>
        <td><input type=Date name="endDate" value="<?php echo $event->getEndDate() ?>"></td>
      </tr>
      <tr>
        <td>Show Date</td>
        <td><input type=checkbox name="showDate" value="1" <?php if($event->getShowDate()){echo "checked";} ?>></td>
      </tr>
      <tr>
        <td>Type</td>
        <td><select name="kategoria">
          <?php
            foreach($types as $type){
              echo "<option value='" . $type . "' ";
              if($type == $event->getKategoria()){
                echo "selected";
              }
              echo ">" . $type . "</option>";
            }
           ?>

        </select></td>
      </tr>
      <tr>
        <td>Attachments</td>
        <td>PLACEHOLDER</td>
      </tr>
      <tr>
        <td>Description</td>
        <td><textarea name="text" rows="30" cols="100"><?php echo $event->getDescription() ?></textarea></td>
      </tr>
      <tr>
        <td></td>
        <td><input type=submit value="Save"></td>
      </tr>
    </table>

    </form>



    <?php

    } else {
        include 'index.php';
    } ?>
