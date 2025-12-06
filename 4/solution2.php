<?php

function solve($file): int
{
    $board = [];
    $result = 0;
    while (($line = fgets($file)) !== false) {
        $board[] = str_split($line);
    }
    while (true) {
        $runResult = 0;
        $toRemove = [];
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
                        $runResult += 1;
                        $toRemove[] = [$r, $c];
                    }
                }
            }
        }
        $result += $runResult;
        clearTable($board, $toRemove);
        if ($runResult === 0) break;
    }

    return $result;
}

function clearTable(&$board, $toRemove): void
{
    foreach ($toRemove as $item) {
        $board[$item[0]][$item[1]] = ".";
    }
}

$file = fopen("input.txt", 'r');
print(solve($file));
fclose($file);


