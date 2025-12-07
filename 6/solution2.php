<?php

function solve($file): int
{
    $lines = [];
    $maxLength = 0;
    $board = [];
    $result = 0;
    while (($line = fgets($file)) !== false) {
        $line = str_replace("\n", "", $line);
        $lines[] = $line;
        $maxLength = max($maxLength, strlen($line));
    }
    foreach ($lines as $line) {
        for ($i = $maxLength-1; $i >= 0; $i--) {
            $char = $line[$i] ?? '';
            if (!isset($board[$i])) $board[$i] = [$char];
            else $board[$i][] = $char;
        }
    }
    $parser = [];
    for ($i = count($board) -1; $i >= 0; $i--) {
        $lastEle = end($board[$i]);
        if (in_array($lastEle, ["*", "+"])) {
            $board[$i][-1] = "";
            $parser[] = (int)implode($board[$i]);
            switch ($lastEle) {
                case '*':
                    $result += array_product($parser);
                    $parser = [];
                    break;
                case '+':
                    $result += array_sum($parser);
                    $parser = [];
                    break;
            }
        } elseif(is_numeric(implode($board[$i]))) {
            $parser[] = (int)implode($board[$i]);
        }
    }
    return $result;
}

$file = fopen("input.txt", 'r');
print(solve($file));
fclose($file);


