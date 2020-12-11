<?php

ini_set("display_errors", 1);

error_reporting(E_ALL);

/**
 * Description of day5
 *
 * @author reinaldo
 */
class day5 {
    
    public $input;
    
    private $rows = 127;
    
    private $cols = 7;
    
    public $result = 0;
    
    private $busqueda;
    
    public $myseat;

    public function __construct() {
        
        $this->input = str_replace("\n", "", file("./input"));
        
    }
    
    public function binaryBoarding(): int {
        
        $prueba = [];
        
        foreach ($this->input as $value) {
            
            $this->binarySearch(0, $this->rows, substr($value, 0, -3));
            
            $row = $this->busqueda;
            
            $this->binarySearch(0, $this->cols, substr($value, -3, 3));
            
            $col = $this->busqueda;
            
            $result = $row*8+$col;
            
            $prueba[] = $result;
            
            $this->result = ($result>$this->result)?$result:$this->result;            
            
        }
        
        $this->myseat = min(array_diff(range(min($prueba), max($prueba)), $prueba));
        
        return $this->result;
        
    }
    
    public function binarySearch(int $init, int $end, string $direction): void{
        
        
        $partition = floor(($end-$init)/2);
        
        if ($direction[0] == "F" || $direction[0] == "L") {
            
            $init = $init;
            $end = $init+$partition;            
            
        }else{
            
            $init = $end-$partition;
            $end = $end;
            
        }
        
        if (strlen($direction)>1) {
            
            $direction = substr($direction, 1, strlen($direction));
            
            self::binarySearch($init, $end, $direction);
            
        }else{
            
            $this->busqueda =  $init;
            
        }
        
    }
    
}


$advent = new day5();

echo "big id : " . $advent->binaryBoarding(). " my seat : " . $advent->myseat;