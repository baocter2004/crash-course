<?php
declare(strict_types=1);

$posts = [
    ['title' => 'A', 'views' => 5],
    ['title' => 'B', 'views' => 20],
    ['title' => 'C', 'views' => 11],
];

// use foreach and prinf items
foreach ($posts as $i => $post) {
    printf("STT %d: %s (%d views)\n", $i + 1, $post['title'], $post['views']);
}