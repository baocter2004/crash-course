<?php
declare(strict_types=1);

// using array_reduce to caculate two numbers in an array
$numbers = [1, 2, 3, 4, 5, 6];

// sum of all numbers in the array
$sum = array_reduce($numbers, fn (int $carry, int $number) => $carry + $number, 0);
echo $sum . PHP_EOL;

// product of all numbers in the array
$product = array_reduce($numbers, fn (int $carry, int $number) => $carry * $number, 1);
echo $product . PHP_EOL;