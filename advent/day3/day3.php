<?php

ini_set("display_errors", 1);

error_reporting(E_ALL);

/**
 * Description of day3
 *
 * @author reinaldo
 */

class day3 {
    
    public array $puzzle;
    
    public function __construct() {
        
        $this->puzzle = str_replace("\n", "", file("./input"));
        
    }
    
    public function buscarColumna(int $numerador, int $denominador): int{

        return $numerador%$denominador;

    }
    
    public function TobogganTrajectory(int $right, int $down): int {
        
        $initiate = $right;
        
        $trees = 0;
                        
        for ($i = 0; $i < count($this->puzzle); $i+=$down) {
            
            if (!isset($this->puzzle[$i+$down])) {
                break;
            }
            
            $string = $this->puzzle[$i+$down];
            
            $strlen = strlen($string);
            
            $trees = ($string[$this->buscarColumna($initiate, $strlen)] == "#")?$trees+1:$trees;
            
            $initiate = $initiate+$right;
            
        }
        
        return $trees;
        
    }   
    
}
//echo 32%31;exit;
$tobogan = new day3();

echo $tobogan->TobogganTrajectory(3, 1). "\n";

$product = $tobogan->TobogganTrajectory(3,1)*
        $tobogan->TobogganTrajectory(1, 1)*
        $tobogan->TobogganTrajectory(5, 1)*
        $tobogan->TobogganTrajectory(7, 1)*
        $tobogan->TobogganTrajectory(1, 2);

echo $product. "\n";
