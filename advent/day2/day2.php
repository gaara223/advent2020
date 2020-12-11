<?php

/**
 * Description of day2
 *
 * @author reinaldo
 */
class day2 {
    
    public $puzzle;
    
    public function __construct() {
        
        $this->puzzle = array_map("trim", file("./input"));
        
    }
    
    public function passwordPhilosophy(){
        
        $assets = 0;
        
        for ($i = 0; $i < count($this->puzzle); $i++) {
            
            $exploded = explode(":", $this->puzzle[$i]);
            $letter = explode(" ", $exploded[0])[1];
            $values = explode("-", explode(" ", $exploded[0])[0]);
            $min = $values[0];
            $max = $values[1];
            $password = trim($exploded[1]);
            $contain = substr_count($password, $letter);
            
//            echo $min . " - " . $max . " - " . $contain . "<br/>";
            
            $assets = ($contain>=$min && $contain<=$max)?$assets+1:$assets;
                        
        }
//        return json_encode($this->puzzle);
        return $assets;
        
    }
    
    public function passwordPhilosophy2() {
        
        $assets = 0;
        
        for ($i = 0; $i < count($this->puzzle); $i++) {
            
            $exploded = explode(":", $this->puzzle[$i]);
            $letter = explode(" ", $exploded[0])[1];
            $values = explode("-", explode(" ", $exploded[0])[0]);
            $min = $values[0]-1;
            $max = $values[1]-1;
            $password = str_split(trim($exploded[1]));
            
            
            $assets = (
                    $password[$min] == $letter && $password[$max] != $letter ||
                    $password[$max] == $letter && $password[$min] != $letter
                    )?$assets+1:$assets;
                        
        }
        
        return $assets; 
        
    }
    
}

$puzzle = new day2();

echo $puzzle->passwordPhilosophy() . PHP_EOL;

echo $puzzle->passwordPhilosophy2();

