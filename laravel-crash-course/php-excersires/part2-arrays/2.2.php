<?php
declare(strict_types=1);

$posts = ['title' => 'Hello', 'views' => 10];

// print title
echo $posts['title'], "\n";

// change value of views to 11
$posts['views'] = 11;
echo $posts['views'], "\n";

// add key 'author' has value is 'Bao'
$posts['author'] = 'Bao';
// print 'author'
echo $posts['author'], "\n";

// Delete key 'author' use unset
unset($posts['author']);
echo json_encode($posts), "\n";
