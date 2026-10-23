<?php
declare(strict_types=1);

$posts = ['title' => 'Hello', 'views' => null];

echo $posts['title'] ?? 'N/A', "\n"; // Hello
echo $posts['xxx'] ?? 'N/A', "\n"; // N/A
echo $posts['views'] ?? 'N/A', "\n"; // N/A

$posts = [['title' => 'A'], ['title' => 'B']]; 
echo $posts[1]['title'], "\n"; // B
echo $posts[5]['title'] ?? 'không có', "\n"; // không có
