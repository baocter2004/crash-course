<?php
declare(strict_types=1);

// Cho $scores = ['an' => 70, 'binh' => 90, 'chi' => 80] . 
// Dự đoán 7 dòng JSON được in ra, mỗi dòng
// bắt đầu từ bản sao mới của $scores :

$scores = ['an' => 70, 'binh' => 90, 'chi' => 80];

$a = $scores;
asort($a);
echo 'asort:
', json_encode($a), "\n";

$a = $scores;
arsort($a);
echo 'arsort: ', json_encode($a), "\n";
// sắp xếp giảm dần theo giá trị, giữ nguyên key
// arsort: {"binh":90,"chi":80,"an":70}

$a = $scores;
ksort($a);
echo 'ksort:', json_encode($a), "\n";
// sắp xếp tăng dần theo key, giữ nguyên key
// ksort: {"an":70,"binh":90,"chi":80}


$a = $scores;
krsort($a);
echo 'krsort: ', json_encode($a), "\n";
// sắp xếp giảm dần theo key, giữ nguyên key
// krsort: {"chi":80,"binh":90,"an":70}

$a = $scores;
sort($a);
echo 'sort:', json_encode($a), "\n";
// sắp xếp tăng dần theo giá trị
// sort: [70,80,90]

$a = $scores;
rsort($a);
echo 'rsort: ', json_encode($a), "\n";
// sắp xếp giảm dần theo giá trị
// rsort: [90,80,70]

$a = array_values($scores);
sort($a);
echo 'values: ', json_encode($a), "\n";
// sắp xếp tăng dần theo giá trị
// values: [70,80,90]