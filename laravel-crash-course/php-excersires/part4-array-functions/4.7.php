<?php
declare(strict_types=1);

// Với 5 bài viết bên dưới, tính tổng views của các bài có views > 10. 
// Dùng array_filter , array_column , array_sum . 
// Kết quả mong đợi: 20 + 11 + 40 = 71 .

$posts = [
    ['title' => 'A', 'views' => 5],
    ['title' => 'B', 'views' => 20],
    ['title' => 'C', 'views' => 11],
    ['title' => 'D', 'views' => 3],
    ['title' => 'E', 'views' => 40]
];

// step 1 : filter posts with views > 10
$filteredPosts = array_filter($posts, fn($post) => $post['views'] > 10);
print_r($filteredPosts);

// step 2 : get views column
$views = array_column($filteredPosts, 'views');
print_r($views);

// step 3 : sum views
$totalViews = array_sum($views);
echo $totalViews, "\n"; // 71