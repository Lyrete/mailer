<?php

include_once "user.php";


class UserPDO{
    public $pdo;

    public function __construct() {
        
        $this->pdo = $this->initDB();        
    }

    function initDB(){
        $dsn = 'mysql:dbname=newsletter;host=localhost;charset=UTF8';
        try{
            include_once "values.php";
            $conn = new PDO($dsn, $vars["dbUser"], $vars["dbPw"]);
            return $conn;
        } catch (PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function getUser($user){
        //returns only one because registration doesn't allow duplicate names because text not able to be unique in DB
        $sql = "SELECT * from users WHERE user = ?";

        $q = $this->pdo->prepare($sql);
        $q->execute(array($user));

        $user = $q->fetchObject("User");

        if ($user == null) {
            return null;
        } else {
            return $user;
        }

    }

    function addUser($user, $email, $pw, $name){
        $sql = "INSERT INTO users (user,email,pw,name,usr_lvl) VALUES (?,?,?,?,?)";

        $q = $this->pdo->prepare($sql);
        $q->execute(array($user, $email, $pw, $name, "user"));
    }

    function validateUser($user, $pw){
        if(!$this->getUser($user)){ //returns false if no user in db kind of unnecessary
            return FALSE;
        }

        if(password_verify($pw, $this->getUser($user)->getPw())){ //checks for the hashed pw
            return TRUE;
        }else if($pw = $this->getUser($user)->getPw()){ //checks for a plain text pw for testing
            return TRUE;
        }

        return FALSE;
    }

    function updateUser($username, $user){
        $id = $this->getUser($username)->getId();

        $sql = "UPDATE users SET user = ?, name = ?, usr_lvl = ?, email = ?, pw = ? WHERE id = ?";
        $q = $this->pdo->prepare($sql);
        $q->execute(array($user->getUser(), $user->getName(), $user->getUsr_lvl(), $user->getEmail(), $user->getPw(), $user->getId()));
    }
}

?>
