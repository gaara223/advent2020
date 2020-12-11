<?php

$memoria_inicial = memory_get_usage();

$start = microtime(true);

$matriz = [];

$n = 4500;

$valorBuscar = 19814227;

for ($i = 0; $i < $n; $i++) {
    
    $matriz[$i] = range(($n*$i), ($n*($i+1))-1);
    
}

$memoria_de_matriz = memory_get_usage();

for ($i = 0; $i < $n; $i++) {
    
    for ($j = 0; $j < $n; $j++) {
        
        if ($valorBuscar == $matriz[$i][$j]) {
            
            $end = microtime(true);
            
            $exetime = $end-$start;
            
            echo json_encode([
                "Dimension de la matris" => $n,
                "Valor a Buscar" => $valorBuscar,
                "Fila" => $i+1,
                "Columna" => $j+1,
                "Tiempo de ejecucion" => "diferencia de " . $end . " - " . $start . " = " . number_format($exetime, 3),
                "Cantidad de memoria usada " => [
                    "memoria inicial " => $memoria_inicial,
                    "memoria al armar matriz" => $memoria_de_matriz,
                    "Al conseguir el valor en matriz"=>memory_get_usage()
                    ]
            ]);
            exit;
            
        }
        
    }
    
}