<style><?php include 'styles.css'?></style>

<?php

require_once 'database.php';

session_start();

$db = new DB();

?>

<head>
    <body>  
        <?php include 'navigation.php' ?>
                
        <div class="loginForm">
            <?php
            if(isset($_POST["user"]) and isset($_POST["pw"])){
                if($db->validateUser($_POST["user"], $_POST["pw"])){
                    echo 'Logged in';
                    $_SESSION["user"] = $db->getUser($_POST["user"], $_POST["pw"]);
                } else {
                    echo 'Wrong username or password. Try again.';
                    $_SESSION["user"] = NULL;
                }
            }
            ?>
    <form action="index.php" method="post">
        User: <input type="text" name="user"><br>
        Password: <input type="password" name="pw"><br>
        <input type="submit" value="Login">
    </form>
        </div>
    
    

    </body>
</head>