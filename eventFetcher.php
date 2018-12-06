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

    function getAllEvents(){
        $sql = "SELECT * FROM event";
        $q = $this->pdo->prepare($sql);
        $q->execute();

        $events = array();

        foreach ($q->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $events[] = $this->getEvent($tulos->id);
        }

        return $events;
    }

}
