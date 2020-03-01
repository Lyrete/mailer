<?php
include 'userPDO.php';
session_start();

if($_SESSION["user"] != NULL){

    include 'navigation.php';

?>


<table>
<form action="wnlAdded.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    Event: <input type="text" name="subject" required> (<b>Don't enter a date at the end the script does it automatically!!!!!</b>)<br>
    Start date: <input type="date" name="startDate"><br>
    End date: <input type="Date" name="endDate"> (Don't enter if the event is one day only)
    <br>
    <input type="checkbox" name="showDate" checked> Show date <br>
    <input type="radio" name="eventType" value="atiedotus">Kilta tiedottaa
    <input type="radio" name="eventType" value="kilta" checked>Killan tapahtuma
    <input type="radio" name="eventType" value="muu">Muu tapahtuma
    <input type="radio" name="eventType" value="ylim">Muuta
    <br>
    Attachment: <input type="file" name="fileToUpload" id="fileToUpload"><br>
    Text: <textarea name="text" rows="30" cols="150" required></textarea><br>

<input type="submit">
</table>

<?php

} else {
    include 'index.php';
}
