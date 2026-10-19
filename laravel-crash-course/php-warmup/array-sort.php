<?php
declare(strict_types=1);

var_dump(1 <=> 2, 2 <=> 2, 3 <=> 2);

$posts = [
    ['title' => 'A', 'views' => 5],
    ['title' => 'B', 'views' => 20],
    ['title' => 'C', 'views' => 11],
    ['title' => 'D', 'views' => 3],
    ['title' => 'E', 'views' => 40],
];

$sorted = $posts;
usort($sorted, fn (array $a, array $b): int => $b['views'] <=> $a['views']);

function handleSort (array $arr): array
{
    $n = count($arr);

    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - 1 - $i; $j++) {
            if ($arr[$j]['views'] < $arr[$j + 1]['views']) {
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
            }
        }
    }

    return $arr;
}


echo implode(', ', array_column(handleSort($posts), 'title')), "\n";
echo implode(', ', array_column($sorted, 'title')), "\n";
echo implode(', ', array_column($posts, 'title')), "\n";