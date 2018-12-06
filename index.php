<style><?php include 'styles.css'?></style>

<?php

require_once 'database.php';
include_once 'userPDO.php';

$db = new DB();
$userPDO = new userPDO();

session_start();

?>

<head>
    <body>
        <?php include 'navigation.php' ?>


            <?php
            $user = filter_input(INPUT_POST, 'user');
            $pw = filter_input(INPUT_POST, 'pw');
            if(isset($user) and isset($pw)){
                if($userPDO->validateUser($user, $pw)){
                    echo 'Logged in as ' . $userPDO->getUser($user)->getName();
                    $_SESSION["user"] = $userPDO->getUser($user);
                } else {
                    echo 'Wrong username or password. Try again.';
                    $_SESSION["user"] = NULL;
                }
            }
            ?>
    <div class="loginForm">
    <form action="index.php" method="post">
        User: <input type="text" name="user"><br>
        Password: <input type="password" name="pw"><br>
        <input type="submit" value="Login">
    </form>
    </div>



    </body>
</head>
