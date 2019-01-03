<?php

include_once 'Event0.php';

class eventFetcher{

    public $pdo;

    public function __construct() {
        $this->pdo = $this->initDB();
    }

    function initDB(){
        $dsn = 'mysql:dbname=newsletter;host=localhost;charset=UTF8';
        try{
            $conn = new PDO($dsn, "dbConnect", "connectsalainen");
            return $conn;
        } catch (PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function getEventsInPeriod($startDate, $endDate){
        $sql = "SELECT * FROM event WHERE startDate >= ? AND startDate <= ? OR endDate >= ? ORDER BY kategoria, startDate";
        $q = $this->pdo->prepare($sql);
        $q->execute(array($startDate, $endDate, $startDate));

        $events = array();

        foreach ($q->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $events[] = $this->getEvent($tulos->id);
        }

        return $events;
    }

    function getEvent($id){
        $sql = "SELECT * FROM event WHERE id = ? LIMIT 1";
        $q = $this->pdo->prepare($sql);
        $q->execute(array($id));

        $event = $q->fetchObject("Event");

        if ($event == null) {
            return null;
        } else {
            return $event;
        }
    }

    function getAllEvents($sort){
        if($sort == "date"){
          $sql = "SELECT * FROM event ORDER BY startDate DESC";
        }else{
          $sql = "SELECT * FROM event";
        }
        $q = $this->pdo->prepare($sql);
        $q->execute();

        $events = array();

        foreach ($q->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $events[] = $this->getEvent($tulos->id);
        }

        return $events;
    }

    function updateEvent($event){
        if(isset($_POST["text"])){
            $event->setName(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
            $event->setStartDate(filter_input(INPUT_POST, "startDate", FILTER_SANITIZE_STRING));
            $event->setEndDate(filter_input(INPUT_POST, "endDate", FILTER_SANITIZE_STRING));
            $event->setDescription(filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING));
            $event->setKategoria(filter_input(INPUT_POST, "kategoria", FILTER_SANITIZE_STRING));
        }

        $sql = "UPDATE event SET startDate = ?, endDate = ?, description = ?, kategoria = ? WHERE id = ?";
        $q = $this->pdo->prepare($sql);
        $q->execute(array($event->getStartDate(), $event->getEndDate(), $event->getDescription(), $event->getKategoria(), $event->getId()));
    }

    function deleteEvent($id){
        $sql = "DELETE FROM event WHERE id = ?";
        $q = $this->pdo->prepare($sql);
        $q->execute(array($id));
    }

    function addEvent($event){
        $sql = "INSERT INTO event (name, startDate, endDate, kategoria, description) VALUES (?,?,?,?,?)";
        $q = $this->pdo->prepare($sql);
        try{
          $q->execute(array($event->getName(), $event->getStartDate(), $event->getEndDate(), $event->getKategoria(), $event->getDescription()));
        } catch (PDOException $e){
            echo "Something went wrong: " . $e->getMessage();
        }
    }

}
