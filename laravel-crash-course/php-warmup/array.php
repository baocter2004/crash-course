<?php
declare(strict_types=1);

function printSection(string $title, mixed $data): void
{
    echo "\n=== {$title} ===\n";
    echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), "\n";
}

$posts = [
    ['title' => 'A', 'views' => 5],
    ['title' => 'B', 'views' => 20],
    ['title' => 'C', 'views' => 11],
    ['title' => 'D', 'views' => 3],
    ['title' => 'E', 'views' => 40],
];

$popular = array_filter($posts, fn (array $p): bool => $p['views'] > 10);
$titles  = array_map(fn (array $p): string => $p['title'], $popular);
$list    = array_values($titles);

printSection('array_filter (giữ key)', $popular);
printSection('array_map (vẫn giữ key)', $titles);
printSection('array_values (đánh lại index)', $list);

foreach ($posts as $i => $post) {
    printf("STT %d: %s (%d views)\n", $i + 1, $post['title'], $post['views']);
}