<?php
declare(strict_types=1);

// Không dùng usort . Viết hàm handleSort(array $arr): array sắp xếp các bài viết theo views giảm dần
// bằng bubble sort: lặp đi lặp lại so sánh hai phần tử cạnh nhau 
// và đổi chỗ nếu sai thứ tự. Dùng hai vòng for lồng nhau. 
// In danh sách title theo thứ tự đã sắp, và chứng minh $posts gốc không bị đổi.

$posts = [
    ["title" => "Vue", "views" => 50],
    ["title" => "Laravel", "views" => 100],
    ["title" => "Docker", "views" => 100],
    ["title" => "PHP", "views" => 50],
    ["title" => "Redis", "views" => 100]
];

// handle sort function
function handleSort(array $array): array {
    $count = count($array);

    for($i=0; $i < $count; $i++) {
        for($j=0; $j < $count - 1; $j++) {
            if ($array[$j]['views'] < $array[$j + 1]['views']) {
                [$array[$j], $array[$j + 1]] = [$array[$j + 1], $array[$j]];
            }
        }
    }
    return $array;
}

$newPosts = handleSort($posts);

echo "Before sort: \n";
foreach($posts as $post) {
    echo $post['title'], " - ", $post['views'], "\n";
}

echo "After sort: \n";
foreach($newPosts as $post) {
    echo $post['title'], " - ", $post['views'], "\n";
}