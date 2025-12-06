<?php

function solve($file): int {
    $point = 50;
    $result = 0;
    while (($line = fgets($file)) !== false) {
        $flag = false;
        $direction = $line[0];
        $amount = (int) substr($line, 1);
        if ($direction === "R") {
            $result += floor(($point + $amount) / 100);
            $point = ($point + $amount) % 100;
        } else {
            $p = $point - $amount;
            if ($p > 0) $point -= $amount;
            elseif ($p === 0) {
                $result++;
                $point = 0;
            } elseif ($p < 0) {
                if ($point === 0) $result += abs(floor($amount / 100));
                else {
                    $result += abs(floor(($point - $amount) / 100));
                    $flag = true; // check for landing on 0 as well
                }
                $point = $p % 100;
                if ($point < 0) $point = 100 - abs($point);
                elseif ($point === 0 && $flag === true) $result++;
            }

        }
    }
    return $result;
}

$file = fopen("input.txt", 'r');
print(solve($file));
fclose($file);


