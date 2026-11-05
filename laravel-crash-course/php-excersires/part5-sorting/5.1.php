<?php
declare(strict_types=1);

var_dump(1 <=> 2); // -1
var_dump(2 <=> 1); // 1
var_dump(2 <=> 2); // 0
var_dump(3 <=> 2); // 1
var_dump('a' <=> 'b'); // -1
var_dump('b' <=> 'a'); // 1
var_dump([1, 2] <=> [1, 3]); // -1