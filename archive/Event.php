<?php

require 'Date.php';

class Event{
    
    public $text;
    public $startDate;
    public $endDate;
    public $name;
    
    public function __construct($nameInput, $date1, $date2, $textInput) {
        $this->name = $nameInput;
        $this->startDate = $date1;
        $this->endDate = $date2;
        $this->text = $textInput;
    }
    
    public function duration(){
        if($this->endDate->day == '' and $this->endDate->month == ''){
            $duration = (string)$this->startDate;
        } else {
            $duration = $this->startDate . '-' . $this->endDate;
        }
        
        return $duration;
    }
    
    public function HTMLtext(){
        $HTML = '<b>' . $this->name . ' ' . $this->duration() . '</b>'. PHP_EOL . '<br><br>';
        for ($i = 0; $i < strlen($this->text); $i++){
            if($this->text[$i] == "\n"){
                $HTML .= '<br>';                               
            } else {
                $HTML .= $this->text[$i];
            }
        }
        
        return $HTML;
    }
    
    public function rawText(){
        return $this->name . ' '.$this->duration() . PHP_EOL . PHP_EOL . $this->text;
    }
}
