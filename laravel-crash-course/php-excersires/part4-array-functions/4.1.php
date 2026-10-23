<?php
declare(strict_types=1);

$numbers = [1, 2, 3, 4, 5, 6];

// using array_map with arrow function to create a new array with each number doubled
$doubledNumbers = array_map(fn (int $number) => $number * 2, $numbers);
echo json_encode($doubledNumbers) . PHP_EOL;