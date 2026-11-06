<?php
declare(strict_types=1);

final class Money {
    public function __construct(
        public readonly int $amount,
        public readonly string $currency = "VND",
    ) {}

    public function add(Money $money): Money {
        return new Money($this->amount + $money->amount, $this->currency);
    }
}

$a = new Money(100);
$b = $a->add(new Money(50));

echo $a->amount . PHP_EOL;
echo $b->amount . PHP_EOL;

try {
    $a->amount = 200;
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}