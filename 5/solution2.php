<?php

function solve($file): int
{
    $intervals = [];
    $result = 0;
    while (($line = fgets($file)) !== false && $line !== "\n") {
        [$from, $to] = explode("-", $line);
        $intervals[] = [(int)$from, (int)$to];
    }
    // thanks god I didnt brute force this in part 1
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
    foreach ($newIntervals as $newInterval) {
        $result += ($newInterval[1] - $newInterval[0] + 1);
    }
    return $result;

}

$file = fopen("input.txt", 'r');
print(solve($file));
fclose($file);


