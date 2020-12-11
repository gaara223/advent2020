<?php

ini_set("display_errors", 1);

error_reporting(E_ALL);

$memoria_inicial = memory_get_usage();

$start = microtime(true);

function buscarColumna(int $numerador, int $denominador): int{
    
    $producto = floatval($numerador/$denominador);
    
    $decimalCero = "0.". explode(".", $producto)[1];
    
    $columna = floatval($decimalCero)*$denominador;
    
    return intval($columna+1);
    
}

$matriz = [];

$n = $argv[1]??4500;

$valorBuscar = $argv[2]??19814227;

for ($i = 0; $i < $n; $i++) {
    
    $matriz[$i] = range(($n*$i), ($n*($i+1))-1);
    
}

$memoria_de_matriz = memory_get_usage();

$fila = intval($valorBuscar/$n)+1;

$columna = buscarColumna($valorBuscar, $n);

$end = microtime(true);

$exetime = $end-$start;

echo json_encode([
    "Dimension de la matris" => $n,
    "Valor a Buscar" => $valorBuscar,
    "Fila" => $fila,
    "Columna" => $columna,
    "Tiempo de ejecucion" => "diferencia de " . $end . " - " . $start . " = " . number_format($exetime, 3),
    "Cantidad de memoria usada " => [
        "memoria inicial " => $memoria_inicial,
        "memoria al armar matriz" => $memoria_de_matriz,
        "Al conseguir el valor en matriz"=>memory_get_usage()
        ],
    "argv" => $argv??"nada"
]);
?>