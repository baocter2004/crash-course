<?php

declare(strict_types=1);

final class Money
{
    public function __construct(
        public readonly int $amount,
        public readonly string $currency = 'VND',
    ) {}

    public function add(Money $other): Money
    {
        return new Money($this->amount + $other->amount, $this->currency);
    }
}

$a = new Money(100);
$b = $a->add(new Money(50));

echo $a->amount, "\n";
echo $b->amount, "\n";

$x = new Money(1);
$y = $x;
$z = new Money(1);

var_dump($x === $y);
var_dump($x === $z);
var_dump($x == $z);

$a->amount = 999;
