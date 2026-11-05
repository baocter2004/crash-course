<?php
declare(strict_types=1);

function add(int $a, int $b): int
{
    return $a + $b;
}

// add so nguyen => khong co loi
echo add(1, 2) . "\n";

// add mot chuoi
try {
    echo add("2", 4) . "\n";
} catch (TypeError $e) {
    echo "Error: " . get_class($e) . "\n";
}