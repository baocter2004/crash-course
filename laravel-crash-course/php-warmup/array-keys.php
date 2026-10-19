<?php
declare(strict_types=1);

$numbers = [1,2,3,4,5,6];

$evens = array_filter($numbers, fn (int $n): bool => $n % 2 === 0);
var_dump(array_is_list($evens));
echo json_encode($evens), "\n";

$scaled = array_map(fn (int $n): int => $n * 10, $evens);
echo json_encode($scaled), "\n";

$list = array_values($scaled);
var_dump(array_is_list($list));
echo json_encode($list), "\n";

echo $evens[0] ?? 'Không có key 0', "\n";
echo $evens[1], "\n";