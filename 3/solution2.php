<?php

function solve($file): int
{
    $r = 0;
    while (($line = fgets($file)) !== false) {
        $result = [];
        $line = trim($line);
        $offset = 0;
        $spaceLen = strlen($line);
        for ($x = 12; $x > 0; $x--) {
            $interval = substr($line, $offset, $spaceLen - $x - $offset + 1);
            $maxDigit = max(str_split($interval));
            $index = strpos($interval, $maxDigit);
            $result[] = $interval[$index];
            $offset += $index + 1;
        }
        $r += (int)implode("", $result);
    }
    return $r;
}

$file = fopen("input.txt", 'r');
print(solve($file));
fclose($file);


