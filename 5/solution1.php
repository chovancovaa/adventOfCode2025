<?php

function solve($file): int
{
    $intervals = [];
    $ingredients = [];
    $result = 0;
    while (($line = fgets($file)) !== false) {
        if (str_contains($line, "-")) {
            [$from, $to] = explode("-", $line);
            $intervals[] = [(int)$from, (int)$to];
        } elseif ($line !== "\n") {
            $ingredients[] = (int)$line;
        }
    }
    // we aint brute forcing this
    usort($intervals, function($a, $b) {return $a[0] <=> $b[0];});

    $newIntervals = [];
    $previousInterval = null;
    foreach ($intervals as $idx => $interval) {
       if ($idx === 0) {
           $previousInterval = $interval;
           continue;
       }
        if ($previousInterval[1] >= $interval[0] && $previousInterval[0] <= $interval[1]) {
            $newInterval = [min($interval[0], (int)$previousInterval[0]), max($interval[1], (int)$previousInterval[1])];
            $previousInterval = $newInterval;
        } else {
            $newIntervals[] = $previousInterval;
            $previousInterval = $interval;
        }
    }
    $newIntervals[] = $previousInterval;
    foreach ($ingredients as $ingredient) {
        foreach ($newIntervals as $newInterval) {
            if ($ingredient >= $newInterval[0] && $ingredient <= $newInterval[1]) {
                $result++;
                break;
            }
        }
    }
    return $result;

}

$file = fopen("input.txt", 'r');
print(solve($file));
fclose($file);


