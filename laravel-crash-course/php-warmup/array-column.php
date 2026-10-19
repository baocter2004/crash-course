<?php
declare(strict_types=1);

$posts = [
    ['title' => 'A', 'views' => 5],
    ['title' => 'B', 'views' => 20],
    ['title' => 'C', 'views' => 11],
];

echo json_encode(array_column($posts, 'title')), "\n";
echo json_encode(array_column($posts, 'views', 'title')), "\n";

$popular = array_filter($posts, fn (array $p): bool => $p['views'] > 10);
echo json_encode(array_column($popular, 'title')), "\n";