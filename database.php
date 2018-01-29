<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DB{
    
    function __construct(){
        $this->conn = mysqli_connect('localhost', 'dbConnect', 'connectsalainen','newsletter');
        mysqli_set_charset($this->conn, 'utf8');
    }
    
    function getRow($sql){
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
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
    
    function getBotApi(){
        $sql = 'SELECT * FROM bots WHERE name LIKE \'TiedotusBot\'';
        $bot = $this->getRow($sql);
        
        return $bot["apikey"];
    }
    
    function addFullLetter($text, $week, $filename, $attachments){
        $finalText = '';
        for ($i = 0; $i < strlen($text); $i++){
    
            if($text[$i] == "'"){                                // adds a \ before ' symbols because of problems otherwise
                $finalText .= "\'";                               
            } else {
                $finalText .= $text[$i];
            }
        }
        
        $sql = 'INSERT INTO letters (week, created, contents, filename, attachments)' .
                "VALUES ('" . $week . "','" .
                date('Y-m-d') . "','" . $finalText . "','" . $filename . "','" . $attachments . "');";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }
    
    function getPublishedLetterURL($week){
        $sql = 'SELECT * FROM letters WHERE week=' . $week;
        $letter = $this->getRow($sql);
        
        return $letter["filename"];
    }
}

