<?php

function solve(string $input): int {
    $result = 0;
    $items = explode(",", trim($input));

    foreach ($items as $item) {
        [$from, $to] = explode("-", $item);
        $from = (int)$from;
        $to = (int)$to;

        for ($i = $from; $i <= $to; $i++) {
            $str = (string)$i;
            $len = strlen($str);
            if ($len < 2) continue;
            $midPoint = floor($len / 2);
            for ($y = 0; $y < $midPoint; $y++) {
                $substring = substr($str, 0, $y+1);
                $count = substr_count($str, $substring);
                if ($count * strlen($substring) === $len) {
                    $result += (int)$str;
                    break;
                }

            }
        }
    }
    return $result;
}

$input = file_get_contents("input.txt");
print(solve(trim($input)));


