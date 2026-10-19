<?php
declare(strict_types=1);

$numbers = [1,2,3,4,5,6];

$doubled = array_map(fn (int $n): int => $n * 2, $numbers);
echo json_encode($doubled), "\n";

$evens = array_filter($numbers, fn (int $n): bool => $n % 2 === 0);
echo json_encode($evens), "\n";

$sum = array_reduce($numbers, fn (int $carry, int $n): int => $carry + $n, 0);
echo $sum, "\n";