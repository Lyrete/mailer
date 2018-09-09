<?php
session_start();

if($_SESSION["user"] != NULL){
    
    include 'navigation.php';
    $db = new DB();

?>

<form action="addHeader.php" method="post">
    Text: <textarea name="text" rows="30" cols="150" required></textarea><br>
    Language: 
    <input type="radio" name="lng" value="fi" required>fi
    <input type="radio" name="lng" value="eng">eng
    <input type="submit" value="Add header">
</form>

<?php

$text = filter_input(INPUT_POST, 'text');
$lng = filter_input(INPUT_POST, 'lng');

$db->addHeader($text, $lng);

} else {
    include 'index.php';
}

