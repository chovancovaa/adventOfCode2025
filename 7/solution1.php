<?php

function solve($file): int
{
    $result = 0;
    $previousLine = trim(fgets($file));
    $previousLine = str_replace("S", "|", $previousLine);
    while (($line = fgets($file)) !== false) {
        $line = trim($line);
        $indexes = array_keys(str_split($previousLine), '|');
        foreach ($indexes as $idx) {
            if ($line[$idx] === '.') $line[$idx] = '|';
            elseif ($line[$idx] === "^") {
                if ($idx + 1 < strlen($line)) $line[$idx + 1] = '|';
                if ($idx - 1 >= 0) $line[$idx - 1] = '|';
                $result++;
            }
        }
        $previousLine = $line;

    }
    return $result;
}

$file = fopen("input.txt", 'r');
print(solve($file));
fclose($file);


