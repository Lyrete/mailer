<?php
include_once "userPDO.php";
session_start();

if($_SESSION["user"] != NULL){

    include 'navigation.php';
    $db = new DB();
    $user = $_SESSION['user'];

?>




<?php if($user->getUsr_lvl() == "admin"){?>
Add a new user<br><br>

<form action="addUser.php" method="post">
    User: <input type="text" name="user" required><br>
    Password: <input type="password" name="pw" required><br>
    Re-enter password: <input type="password" name="pw2" required><br>
    <input type="submit" value="Add user">
</form>

<?php }

$userIn = filter_input(INPUT_POST, 'user');
$pwIn = filter_input(INPUT_POST, 'pw');

if(isset($userIn) && !$db->getUser($userIn)){
    $db->addUser($userIn, $pwIn);
    echo "User " . $userIn . " added!";
} else {
    echo "User " . $userIn . " already exists, pick another name!";
}

} else {
    include 'index.php';
}
