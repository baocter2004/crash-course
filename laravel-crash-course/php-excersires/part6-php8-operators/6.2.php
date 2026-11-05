<?php
declare(strict_types=1);

// ??= gán nếu chưa có

$config = ['limit' => 0];

// gán limit mặc định 15
$config['limit'] ??= 15;
// gán sort mặc định 'desc'
$config['sort'] ??= 'desc';

echo json_encode($config), "\n";

$count = [];
foreach (['a', 'b', 'a', 'c', 'a'] as $letter) {
    $count[$letter] ??= 0;
    $count[$letter]++;
}
echo json_encode($count), "\n";