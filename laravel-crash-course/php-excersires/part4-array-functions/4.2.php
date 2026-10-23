<?php
declare(strict_types=1);

$numbers = [1, 2, 3, 4, 5];

$evens = array_filter($numbers, fn (int $number) => $number % 2 === 0);
echo json_encode($evens) . PHP_EOL;
var_dump(array_is_list($evens)); // false