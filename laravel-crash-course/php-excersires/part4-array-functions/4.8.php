<?php
declare(strict_types=1);

// Từ 5 bài viết A..E ở bài 4.7, in ra title của 3 bài có nhiều views nhất, 
// cách nhau bằng dấu phẩy, theo thứ tự giảm dần: E, B, C .
// Dùng usort (sao chép mảng trước để không làm đổi $posts gốc) và array_slice .

$posts = [
    ['title' => 'A', 'views' => 5],
    ['title' => 'B', 'views' => 20],
    ['title' => 'C', 'views' => 11],
    ['title' => 'D', 'views' => 3],
    ['title' => 'E', 'views' => 40]
];

// step 1 : copy posts - because usort will change the original array
$copyPosts = $posts;

// step 2 : sort by views descending
$newPosts = usort(
    $copyPosts,
    fn($post1, $post2) => $post2['views'] <=> $post1['views']
);

// step 3 : slice top 3 posts
$top3Posts = array_slice($copyPosts, 0, 3);

echo json_encode(array_column($top3Posts, 'title')), "\n";
echo json_encode(array_column($posts, 'title')), "\n";
