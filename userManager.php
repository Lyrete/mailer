<?php
include_once "userPDO.php";
session_start();

if($_SESSION["user"] != NULL){

    include 'navigation.php';
    $db = new DB();
    $user = $_SESSION['user'];

$userPDO = new UserPDO();



?>

<form action="userManager.php" method="post">
    Username: <input type="text" name="user" value="<?php echo $user->getUser();?>" required><br>
    Name: <input type="text" name="name" value="<?php echo $user->getName();?>" required> <br>
    E-mail: <input type="email" name="email" value="<?php echo $user->getEmail();?>" required> <br>
    <br>
    Old password: <input type="password" name="pwOld" required><br>
    New password: <input type="password" name="pwNew"><br>
    Re-enter new password: <input type="password" name="pwNew2"><br>
    <input type="submit" value="Change user details">
</form>


<?php if($user->getUsr_lvl() == "admin"){?>
Admin CP - Add a new user<br><br>

<form action="userManager.php" method="post">
    User: <input type="text" name="userAdd" required><br>
    Name: <input type="text" name="nameAdd" required><br>
    E-mail: <input type="email" name="emailAdd" required><br>
    Password: <input type="password" name="pwAdd" required><br>
    Re-enter password: <input type="password" name="pw2Add" required><br>

    <input type="submit" value="Add user">
</form>

<?php }

//reacting to the first form
if(isset($_POST["pwOld"])){
    $pw = filter_input(INPUT_POST, 'pwOld');
    if(isset($_POST["pwNew"])){
        $pwNew = filter_input(INPUT_POST, "pwNew");
        $pwNew2 = filter_input(INPUT_POST, "pwNew2");
        if($pwNew == $pwNew2){
            $newpw = password_hash($pwNew, PASSWORD_BCRYPT);
        }
    }
    if($userPDO->validateUser($user->getUser(), $pw)){
        $name = filter_input(INPUT_POST, 'name');
        $username = filter_input(INPUT_POST, 'user');
        $email = filter_input(INPUT_POST, 'email');

        $oldUsername = $user->getUser();
        $user->setUser($username);
        $user->setName($name);
        $user->setEmail($email);
        if(isset($newpw)){
            $user->setPw($newpw);
        };
        $userPDO->updateUser($oldUsername, $user);
        echo "Updated user details.";
    }else{
      echo "Wrong password, try again.";
    }
}

if(isset($_POST["userAdd"])){
    $username = filter_input(INPUT_POST, 'userAdd');
    $email = filter_input(INPUT_POST, 'emailAdd');
    $name = filter_input(INPUT_POST, "nameAdd");
    $pw = filter_input(INPUT_POST, "pwAdd");
    $pw2 = filter_input(INPUT_POST, "pw2Add");
    if ($pw == $pw2){
        $hash = password_hash($pw, PASSWORD_BCRYPT);
        if($userPDO->getUser($username) != null){
            $userPDO->addUser($username, $email, $hash, $name);
            echo "User " . $username . " added.";
        } else {
            echo "Username " . $username . " already exists, pick another one.";
        }
    } else {
        echo "The passwords didn't match.";
    }
}


} else {
    include 'index.php';
}
