<?php
ini_set("display_errors", 1);

error_reporting(E_ALL);
/**
 * Description of day6
 *
 * @author reinaldo
 */
class day6 {
    
    public $input;
    
    public int $total = 0;
    
    public int $everyone = 0;
    
    public function __construct() {
        
        $this->input =  explode("/*", str_replace("\n", "-", str_replace("\n\n", "/*", implode(null ,file("./input")))));
        
        $this->customCustoms();
        
    }
    
    public function customCustoms(): void {
        
        foreach (str_replace("-", "", $this->input) as $value) {
            
            $groupansweredYes = strlen(implode(null, array_unique(str_split($value))));
            
            $this->total += $groupansweredYes;
            
        }
        
    }
    
    public function partTwo() {
        
        foreach ($this->input as $value) {
            
            $arrayValues = explode("-", $value);
            
//            echo json_encode($arrayValues) . " || ". is_array($arrayValues);
            if (count($arrayValues)==1) {
                
                $this->everyone += strlen($arrayValues[0]);
                
            }else{
            
                $intersect = call_user_func_array('array_intersect', array_map('str_split', $arrayValues));
                $this->everyone += count($intersect);
                
            }
            
            
        }
        
    }
    
}

$advent = new day6();

echo $advent->total;

$advent->partTwo();

echo $advent->everyone;
