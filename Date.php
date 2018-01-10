<?php

class Date{
    
    public $day;
    public $month;
    
    function __construct($str1, $str2) {
        $this->day = $str1;
        $this->month = $str2;
        
        if($this->day[0] == '0'){
            $this->day = $this->day[1];
        }
        
        if($this->month[0] == '0'){
            $this->month = $this->month[1];
        }
    }  
    
    function __toString(){
        return $this->day . '.' . $this->month . '.';
    }
    
    function compareTo($value){
        if (!$value instanceof Date){
            throw new Exception("Can only compare two Dates");
        }
        
        if ($this->month > $value->month){
            return 1;
        } elseif ($this->month < $value->month){
            return -1;
        }
        
        if ($this->day > $value->day){
            return 1;
        } elseif ($this->day < $value->day){
            return -1;
        }
        
        return 0;
    }
}

?>

