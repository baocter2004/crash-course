<?php
declare(strict_types=1);

$post = ['title' => 'Hello', 'views' => null];

echo $post['title'] ?? 'N/A', "\n";
echo $post['xxx'] ?? 'N/A', "\n";
echo $post['views'] ?? 'N/A', "\n";

var_dump(isset($post['title']));
var_dump(isset($post['views']));
var_dump(array_key_exists('views', $post));

$posts = [['title' => 'A'], ['title' => 'B']];
echo $posts[1]['title'], "\n";
echo $posts[5]['title'] ?? 'không có', "\n";