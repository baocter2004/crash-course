<?php
declare(strict_types=1);

$post = ['title' => 'Hello', 'views' => null];

var_dump(isset($post['title'])); // true
var_dump(isset($post['views'])); // false
var_dump(array_key_exists('views', $post)); // true
var_dump(isset($post['xxx'])); // false
var_dump(array_key_exists('xxx', $post)); // false