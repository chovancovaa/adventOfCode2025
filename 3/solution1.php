<?php

function getDigitIndexes($line, $digit): array {
    $indexes = [];
    for ($i = 0; $i < strlen($line); $i++) {
        if ($line[$i] === $digit) {
            $indexes[] = $i;
        }
    }
    return $indexes;
}

function solve($file): int
{
    $result = 0;
    while (($line = fgets($file)) !== false) {
        $line = trim($line);
        for ($i = 9; $i > 0; $i--) {
            $i = (string)$i;
            if (!str_contains($line, $i)) continue;
            $maxValueFound = 0;
            $indexes = getDigitIndexes($line, $i);
            foreach ($indexes as $index) {
                $substring = substr($line, $index+1);
                if (empty($substring)) continue;
                $secondMaxDigit = max(str_split($substring));
                if ($secondMaxDigit) {
                    $result += max($maxValueFound, (int)($i . $secondMaxDigit));
                    break 2;
                }
            }
        }
    }
    return $result;
}

$file = fopen("input.txt", 'r');
print(solve($file));
fclose($file);


