<?php
declare(strict_types=1);

$posts = [
    ['title' => 'A', 'views' => 5],
    ['title' => 'B', 'views' => 20],
    ['title' => 'C', 'views' => 11],
    ['title' => 'D', 'views' => 3],
    ['title' => 'E', 'views' => 40]
];

// Với 5 bài viết A..E (views 5, 20, 11, 3, 40), sắp xếp theo views giảm dần vào một biến mới (không đổi $posts
// gốc). In hai dòng title: sau khi sort, và mảng gốc.

$sortedPosts = $posts;

usort($sortedPosts, function ($a, $b) {
    return $b['views'] <=> $a['views'];
});
$sortedPosts = array_reverse($sortedPosts);

echo implode(', ', array_column($sortedPosts, 'title')) . PHP_EOL;
echo implode(', ', array_column($posts, 'title')) . PHP_EOL;