<?php

ini_set("display_errors", 1);

error_reporting(E_ALL);

/**
 * Description of adventOfCode
 * 
 * Chris event for developers
 *
 * @author reinaldo
 */
class firstDay {
    
    public $puzzle;
    
    public function __construct() {
        
        $this->puzzle = array_map("trim", file("./input1.txt"));
        
    }
    
    public function reportRepair() {
        
        $file = $this->puzzle;
        
        for ($i = 0; $i < count($file); $i++) {
            
            $newNumber = 2020-intval($file[$i]);
            
            $number2 = array_search($newNumber, $file);
            
            if ($number2) {
                
                return intval($file[$number2])*intval($file[$i]);
                
            }
            
        }
        
    }
    
    public function secondPart(){
        
        $n = count($this->puzzle);
        
        for ($i = 0; $i < $n; $i++) {
            
            for ($j = 0; $j < $n; $j++) {
                
                if ($i==$j) {
                    
                    continue;
                    
                }
                
                $suma1 = $this->puzzle[$i]+$this->puzzle[$j];
                
                if ($suma1 >=2020) {
                    
                    continue;
                    
                }
                
                $keyNumber = array_search((2020-$suma1), $this->puzzle);
                
                if ($keyNumber) {
                    
                    return $this->puzzle[$i]*$this->puzzle[$j]*$this->puzzle[$keyNumber];
                    
                }                
                
            }
            
        }
        
    }
    
}

$puzzle = new firstDay();

echo "(1)" . $puzzle->reportRepair(). PHP_EOL;

echo "(2)". $puzzle->secondPart();
