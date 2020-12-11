<?php

ini_set("display_errors", 1);

error_reporting(E_ALL);

class validate {

    protected function range(array $range, $value): bool {

        return ($range[0] <= $value && $range[1] >= $value) && (strlen($value) == strlen($range[0]));
    }

    protected function rangeHgt(array $metrics, $metric): bool {

        $height = preg_replace('/[^0-9]/', '', $metric);
        
        switch (true) {
            case strpos($metric, "cm")!==false:
                $type = "cm";

                break;
            case strpos($metric, "in")!==false;
                $type = "in";
                
                break;
            default:
                return false;
                
                break;
        }

        return $this->range($metrics[$type], $height);
    }

    protected function regularExpresion(array $expresion, $string): bool {

        $stringvalidate = str_replace($expresion, "", $string);

        return $stringvalidate == "";
    }

    protected function validateLength(array $expresion, $string): bool {

        return $this->regularExpresion($expresion[1], $string) && strlen($string) == $expresion[0];
    }

    protected function pid(array $metodos, $cid): bool {

        $bad = 0;

        if (!$metodos[0]($cid)) {
            $bad++;
        }
        if (strlen($cid) != $metodos[1]) {
            $bad++;
        }

        return $bad == 0;
    }

}

/**
 * Description of day4
 *
 * @author reinaldo
 */
class day4 extends validate {

    public $input;
    private $conditions;

    public function __construct() {

        $this->conditions = [
            "byr" => [
                "range" => [1920, 2002]
            ],
            "iyr" => [
                "range" => [2010, 2020]
            ],
            "eyr" => [
                "range" => [2020, 2030]
            ],
            "hgt" => [
                "rangeHgt" => [
                    "cm" => [150, 193],
                    "in" => [59, 76]
                ]
            ],
            "hcl" => [
                "validateLength" => [
                    7,
                    array_merge(range("a", "f"), range(0, 9), ["#"])
                ]
            ],
            "ecl" => [
                "regularExpresion" => ["amb", "blu", "brn", "gry", "grn", "hzl", "oth"]
            ],
            "pid" => [
                "pid" => ["is_numeric", 9]
            ],
            "cid" => "optional"
        ];

        $this->input = array_map(function($array) {

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

                if (is_array($value)) {

                    $function = array_key_first($value);

                    $bad += (isset($this->input[$i][$key]) && parent::$function($value[$function], $this->input[$i][$key])) ? 0 : 1;
                }
            }

            $goodPassports += ($bad == 0) ? 1 : 0;
        }

        return $goodPassports;
    }

}

$day4 = new day4();

echo $day4->passportProcessing();
