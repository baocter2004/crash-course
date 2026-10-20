<?php
declare(strict_types=1);

$numbers = [1, 2, 3, 4, 5, 6];

$posts = [
    ['title' => 'A', 'views' => 5],
    ['title' => 'B', 'views' => 20],
    ['title' => 'C', 'views' => 11],
    ['title' => 'D', 'views' => 3],
    ['title' => 'E', 'views' => 40],
];

function handleSort(array $array): array
{
    $array = array_values($array);
    $count = count($array);

    for ($i = 0; $i < $count - 1; $i++) {
        for ($j = 0; $j < $count - 1 - $i; $j++) {
            if ($array[$j]['views'] < $array[$j + 1]['views']) {
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }

    return $array;
}

// Bài 1
$odds    = array_filter($numbers, fn (int $n): bool => $n % 2 !== 0);
$squares = array_map(fn (int $n): int => $n * $n, $odds);
$r1      = array_reduce($squares, fn (int $carry, int $n): int => $carry + $n, 0);

// Bài 2
$popular = array_filter($posts, fn (array $p): bool => $p['views'] > 10);
$r2      = array_sum(array_column($popular, 'views'));

// Bài 3
$top3 = array_slice(handleSort($posts), 0, 3);
$r3   = implode(', ', array_column($top3, 'title'));

echo $r1, "\n";   // 35
echo $r2, "\n";   // 71
echo $r3, "\n";   // E, B, C