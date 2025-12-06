<?php

function solve($file): int
{
    $point = 50;
    $result = 0;
    while (($line = fgets($file)) !== false) {
        $direction = $line[0];
        $amount = (int) substr($line, 1);
        if ($direction === "R") {
            $point = ($point + $amount) % 100;
        } else {
            $point = ($point - $amount) % 100;
            if ($point < 0) $point = 100 - abs($point);
        }
        if ($point === 0) $result++;
    }
    return $result;
}

$file = fopen("input.txt", 'r');
print(solve($file));
fclose($file);


