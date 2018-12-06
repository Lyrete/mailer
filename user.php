<?php
class User{
  private $id;
  private $user;
  private $usr_lvl;
  private $name;
  private $email;
  private $pw;

  function getId(){
    return $this->id;
  }

  function getUser(){
    return $this->user;
  }

  function getUsr_lvl(){
    return $this->usr_lvl;
  }

  function getName(){
    return $this->name;
  }

  function getEmail(){
    return $this->email;
  }

  function getPw(){
    return $this->pw;
  }

  function setId($id){
    $this->id = $id;
  }

  function setUser($user){
    $this->user = $user;
  }

  function setUsr_lvl($usr_lvl){
    $this->usr_lvl = $usr_lvl;
  }

  function setName($name){
    $this->name = $name;
  }

  function setEmail($email){
    $this->email = $email;
  }

  function setPw($pw){
    $this->pw = $pw;
  }


}
