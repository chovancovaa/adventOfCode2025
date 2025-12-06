<?php

function solve($file): int
{
    $board = [];
    $result = 0;
    while (($line = fgets($file)) !== false) {
        $board[] = str_split($line);
    }
    for ($r = 0; $r < count($board); $r++) {
        for ($c = 0; $c < count($board[$r]); $c++) {
            if ($board[$r][$c] === "@") {
                $paperCount = 0;
                // directly to the right
                if ($c < count($board[$r]) - 1) if ($board[$r][$c + 1] === "@") $paperCount++;
                // directly to the left
                if ($c > 0) if ($board[$r][$c - 1] === "@") $paperCount++;
                // directly above
                if ($r > 0) if ($board[$r - 1][$c] === "@") $paperCount++;
                // directly below
                if ($r < count($board) - 1) if ($board[$r + 1][$c] === "@") $paperCount++;
                // directly above and to the right
                if ($r > 0 && $c < count($board[$r]) - 1) if ($board[$r - 1][$c + 1] === "@") $paperCount++;
                // directly above and to the left
                if ($r > 0 && $c > 0) if ($board[$r - 1][$c - 1] === "@") $paperCount++;
                // directly below and to the right
                if ($r < count($board) - 1 && $c < count($board[$r]) - 1) if ($board[$r + 1][$c + 1] === "@") $paperCount++;
                // directly below and to the left
                if ($r < count($board) - 1 && $c > 0) if ($board[$r + 1][$c - 1] === "@") $paperCount++;
                if ($paperCount < 4) {
                    $result += 1;
                }
            }
        }
    }
    return $result;
}

$file = fopen("input.txt", 'r');
print(solve($file));
fclose($file);


