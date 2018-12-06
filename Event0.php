<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Event{
    
    private $name;
    private $kategoria;
    private $id;
    private $startDate;
    private $endDate;
    private $description;
    private $attachment;
    
    function getName(){
        return $this->name;
    }
    
    function setName($name){
        $this->name = $name;
    }
    
    function getKategoria(){
        return $this->kategoria;
    }
    
    function setKategoria($kategoria){
        $this->kategoria = $kategoria;
    }
    
    function getId(){
        return $this->id;
    }
    
    function setId($id){
        $this->id = $id;
    }
    
    function getStartDate(){
        return $this->startDate;
    }
    
    function setStartDate($startDate){
        $this->startDate = $startDate;
    }
    
    function getEndDate(){
        return $this->endDate;
    }
    
    function setEndDate($endDate){
        $this->endDate = $endDate;
    }
    
    function getDescription(){
        return $this->description;
    }
    
    function setDescription($description){
        $this->description = $description;
    }
    
    function getAttachment(){
        return $this->attachment;
    }
    
    function setAttachment($attachment){
        $this->attachment = $attachment;
    }
}

