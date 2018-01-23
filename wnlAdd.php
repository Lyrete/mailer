<?php
session_start();
?>



<form action="wnlAdded.php" method="post" accept-charset="utf-8">
    Event: <input type="text" name="subject"> (<b>Don't enter a date at the end the script does it automatically!!!!!</b>)<br>
    Start date: <input type="date" name="startDate"><br>
    End date: <input type="Date" name="endDate"> (Don't enter if the event is one day only)
    <br>
    <input type="radio" name="eventType" value="kilta" checked>Killan tapahtuma
    <input type="radio" name="eventType" value="muu">Muu tapahtuma
    <input type="radio" name="eventType" value="ylim">Muuta
    <br>
    Text: <textarea name="text" rows="30" cols="150"></textarea><br>

<input type="submit">
