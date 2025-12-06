<?php

function solve(string $input): int {
    $result = 0;
    $items = explode(",", trim($input));
    
    foreach ($items as $item) {
        [$from, $to] = explode("-", $item);
        $from = (int)$from;
        $to = (int)$to;
        
        for ($i = $from; $i <= $to; $i++) {
            $str = (string)$i;
            $len = strlen($str);
            
            // must be at least 2 digits and even length
            if ($len < 2 || $len % 2 !== 0) continue;
            
            $midPoint = $len / 2;
            if (substr($str, 0, $midPoint) === substr($str, $midPoint)) {
                $result += $i;
            }
        }
    }
    return $result;
}

$input = file_get_contents("input.txt");
print(solve(trim($input)));


