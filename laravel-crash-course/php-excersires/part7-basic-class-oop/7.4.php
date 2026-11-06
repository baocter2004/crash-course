<?php
declare(strict_types=1);

// so sánh object ===, == và cùng instance

final class Money
{
    public function __construct(
        public readonly int $amount,
        public readonly string $currency = 'VND',
    ) {
    }
}

$x = new Money(1);
$y = $x;
$z = new Money(1);

var_dump($x === $y); // true
var_dump($x === $z); // false
var_dump($x == $z); // true
var_dump($x == new Money(2)); // false