<?php
declare(strict_types=1);

$posts = [
    ['title' => 'A', 'views' => 5],
    ['title' => 'B', 'views' => 20],
    ['title' => 'C', 'views' => 11],
];

// Array title
$arrayTitles = array_column($posts, 'title');

echo json_encode($arrayTitles), "\n";

// array title => views ( key is title , value is views )
$arrayTitleViews = array_column($posts, "title", "views");
echo json_encode($arrayTitleViews), "\n";

// array title has views > 10
$arrayFilterTitleViews = array_column(array_filter($posts, fn($post) => $post['views'] > 10), "title", "views");
echo json_encode($arrayFilterTitleViews), "\n";