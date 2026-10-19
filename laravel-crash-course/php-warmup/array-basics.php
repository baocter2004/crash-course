<?php
declare(strict_types=1);

$tags = ['php', 'laravel'];
$tags[] = 'composer';
echo $tags[0], "\n";
echo count($tags), "\n";

$post = ['title' => 'Hello', 'views' => 10];
echo $post['title'], "\n";
$post['views'] = 11;
$post['author'] = 'Bao';
unset($post['author']);
print_r($post);