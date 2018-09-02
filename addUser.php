<?php
session_start();

if($_SESSION["user"] != NULL){
    
    include 'navigation.php';
    $db = new DB();

?>

Add a new user<br>

<form action="addUser.php" method="post">
    User: <input type="text" name="user" required><br>
    Password: <input type="password" name="pw" required><br>
    <input type="submit" value="Add user">
</form>

<?php

$user = filter_input(INPUT_POST, 'user');
$pw = filter_input(INPUT_POST, 'pw');

if(isset($user)){
    $db->addUser($user, $pw);
}

} else {
    include 'index.php';
}