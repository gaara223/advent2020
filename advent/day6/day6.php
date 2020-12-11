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
    
    public function __construct() {
        
        $this->input =  explode("/*", str_replace("\n", "", str_replace("\n\n", "/*", implode(null ,file("./input")))));
        
        $this->customCustoms();
        
    }
    
    public function customCustoms(): void {
        
        foreach ($this->input as $value) {
            
            $groupansweredYes = strlen(implode(null, array_unique(str_split($value))));
            
            $this->total += $groupansweredYes;
            
        }
        
    }
    
}

$advent = new day6();

//echo $advent->total;
echo json_encode($advent->input);
