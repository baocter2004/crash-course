<?php
declare(strict_types=1);

$posts = [['title' => 'A'], ['views' => 3], ['title' => 'C']];

// write function safeTitle(array $posts, int $index): string return title of post at index $index or the string
// 'không có' if that index does not exist or if the post lacks a main title.

// Test this using `$posts = [['title' => 'A'], ['views' => 3], ['title' => 'C']]` with the indices 0, 1, 2, and 9.
function safeTitle(array $posts, int $index): string
{
    return $posts[$index]['title'] ?? 'không có';
}
;

foreach ([0, 1, 2, 9] as $index) {
    echo safeTitle($posts, $index), "\n";
}
;