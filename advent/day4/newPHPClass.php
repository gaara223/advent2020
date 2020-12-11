<?php

ini_set("display_errors", 1);

error_reporting(E_ALL);

/**
 * Description of day4
 *
 * @author reinaldo
 */
class day4 {
    
    public $input;
    
    private $conditions = [
        
    "byr" => "required",
    "iyr" => "required",
    "eyr" => "required",
    "hgt" => "required",
    "hcl" => "required",
    "ecl" => "required",
    "pid" => "required",
    "cid" => "optional"

    ];
    
    public function __construct() {
        
        $this->input = array_map(function($array){
            
            $array = explode(" ", $array);
            
            $arrayFinal = [];
            
            foreach ($array as $value) {
                
                $values = explode(":", $value);
                
                $arrayFinal[$values[0]] = $values[1];
                
            }
            
            ksort($arrayFinal);
            
            return $arrayFinal;
            
        }, explode("/*", str_replace(["\n\n", "\n"], ["/*", " "], file_get_contents("./input"))));
        
    }
    
    public function passportProcessing() {
        
        $goodPassports = 0;
        
        for ($i = 0; $i < count($this->input); $i++) {
            
            $bad = 0;
            
            foreach ($this->conditions as $key => $value) {

                if ($value=="required") {
                    
                    $bad += (!isset($this->input[$i][$key]))?1:0;
                    
                }

            }
            
            $goodPassports += ($bad==0)?1:0;
            
        }
        
        return $goodPassports;
        
    }
    
}

$day4 = new day4();

echo $day4->passportProcessing();