<?php

function solve($file): int
{
    $board = [];
    $result = 0;
    while (($line = fgets($file)) !== false) {
        $chars = preg_split('/\s+/', trim($line));
        foreach ($chars as $idx => $char) {
            if (!isset($board[$idx])) $board[$idx] = [$char];
            else $board[$idx][] = $char;
        }
    }
    foreach ($board as $row) {
        $operation = array_pop($row);
        switch ($operation) {
            case '*':
                $result += array_product($row);
                break;
            case '+':
                $result += array_sum($row);
                break;
        }
    }
    return $result;
}

$file = fopen("input.txt", 'r');
print(solve($file));
fclose($file);


