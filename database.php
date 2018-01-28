<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DB{
    
    function __construct(){
        $this->conn = mysqli_connect('localhost', 'dbConnect', 'connectsalainen','newsletter');
        $this->conn->set_charset('utf-8');
    }
    
    function getRow($sql){
        mysqli_query($this->conn, $sql);
    }
    
    function validateUser($user, $pw){
        $sql = 'SELECT * FROM users WHERE user LIKE\'' . $user . '\' and pw LIKE \'' . $pw . '\';';
        $q = mysqli_query($this->conn, $sql);
        $result = mysqli_fetch_assoc($q);
        
        if(sizeof($result) == 3){
            return TRUE;
        } 
        
        return FALSE;    
    }
    
    function getUser($user, $pw){
        $sql = 'SELECT * FROM users WHERE user LIKE\'' . $user . '\' and pw LIKE \'' . $pw . '\';';
        $q = mysqli_query($this->conn, $sql);
        $result = mysqli_fetch_assoc($q);
        
        return $result["id"];
    }
    
    //returns all rows with the sql query
    
    function getWholeResult($sql){
        $result = $this->conn->query($sql);

        $wholeresult = mysqli_fetch_all($result,MYSQLI_ASSOC);
        
        return $wholeresult;
    }
}

