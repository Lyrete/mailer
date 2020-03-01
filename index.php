<style><?php include 'styles.css'?></style>

<?php

include_once 'values.php';
include_once 'userPDO.php';

$values = new Values();
$userPDO = new userPDO();

session_start();

?>

<head>
    <body>
        <?php  ?>


            <?php
            
            $user = filter_input(INPUT_POST, 'user');
            $pw = filter_input(INPUT_POST, 'pw');
            if(isset($user) and isset($pw)){
                if($userPDO->validateUser($user, $pw)){
                    include 'navigation.php';
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
