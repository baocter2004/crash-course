<?php
declare(strict_types=1);

class Product
{
    public function __construct(
        public string $name,
        private int $price,
    ) {
    }

    public function priceAfterDiscount(int $percent): float
    {
        return $this->price - ($this->price * $percent / 100);
    }

    public function label(): string
    {
        return "$this->name - $this->price";
    }
}

$shirt = new Product('áo', 200000);

$shirt->priceAfterDiscount(10);
$shirt->label();

try {
echo $shirt->price;
} catch (Error $e) {
echo $e->getMessage(), "\n";
}