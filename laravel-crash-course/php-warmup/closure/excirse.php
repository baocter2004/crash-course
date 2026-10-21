<?php
declare(strict_types=1);

// 4.1 tính giá sau thuế
$prices = [100, 250, 80, 400];
$tax = 0.1;

$newPrices = array_map(fn (int $price) => $price + ($price * $tax), $prices);
print_r($newPrices);

// 4.2 bộ đếm
function makeCounter(): Closure
{
    $count = 0;

    return function () use (&$count): int {
        return ++$count;
    };
}

$a = makeCounter();
$b = makeCounter();

echo $a() . "\n";
echo $a() . "\n";
echo $b() . "\n";
echo $a() . "\n";