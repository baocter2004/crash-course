<?php
declare(strict_types=1);

$numbers = [1, 2, 3, 4, 5, 6];
$evens = array_filter($numbers, fn (int $number) => $number % 2 === 0);
$scaled = array_map(fn (int $number) => $number * 10, $evens);

echo json_encode($scaled), "\n";

// use array_values to reindex the array
$reindexed_scaled = array_values($scaled);
echo json_encode($reindexed_scaled), "\n";
// print true or false if the array is a list
var_dump(array_is_list($scaled)); // false
var_dump(array_is_list($reindexed_scaled)); // true