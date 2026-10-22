<?php
declare(strict_types=1);

$posts = [
    ['title' => 'A', 'views' => 5],
    ['title' => 'B', 'views' => 20],
    ['title' => 'C', 'views' => 11],
];

// print in the title of the third article by accessing directly
echo json_encode($posts[2]), "\n";

// total of views for posts
$total = 0;
foreach($posts as $post) {
    $total += $post['views'];
}
echo $total, "\n";

// find post has max views
$best = $posts[0];
foreach($posts as $post) {
    if ($post['views'] > $best['views']) {
        $best = $post;
    }
}
echo $best['title'], "\n";