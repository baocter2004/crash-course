<?php
declare(strict_types=1);

// Với dữ liệu dưới đây, sắp xếp theo views giảm dần; 
// nếu views bằng nhau thì theo title tăng dần (A đến
// Z). In ra từng dòng title - views .

$videos = [
    ["title" => "Vue", "views" => 50],
    ["title" => "Laravel", "views" => 100],
    ["title" => "Docker", "views" => 100],
    ["title" => "PHP", "views" => 50],
    ["title" => "Redis", "views" => 100]
];

// method 1 : using usort() with a custom comparison function
// usort($videos, function ($a, $b) {
//     return ($b['views'] <=> $a['views'])
//         ?: ($a['title'] <=> $b['title']);
// });

// method 2 : using if statements
usort($videos,function ($a, $b) {
    if ($a['views'] === $b['views']) {
        return $a['title'] <=> $b['title'];
    }
    return $b['views'] <=> $a['views'];
});
foreach ($videos as $video) {
    echo $video['title'] . " - " . $video['views'], "\n";
}