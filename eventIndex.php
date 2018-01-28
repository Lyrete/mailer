<form action="eventIndex.php" method="post">
    DB-user: <input type="text" name="user"><br>
    Password: <input type="password" name="pw"><br>   

    <input type="submit"> <br> <br>
    
</form>

<?php
    if (isset($_POST["user"]) == TRUE){
        $servername = "localhost";
        $username = $_POST["user"];
        $password = $_POST["pw"];
        $dbName = 'newsletter';
        
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbName);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        echo "Connected successfully";
        
        session_start();
        
        $_SESSION["db"] = $conn;
        
        ?>
    <br>
        <form action="wnlAdd.php">
            <input type="submit" value="Start adding events.">
            
        </form>
    
        <?php
        
        }else{
            echo 'Enter user and password.';
        }

?>
