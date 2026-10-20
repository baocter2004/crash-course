<?php

declare(strict_types=1);

class Product
{
    public function __construct(public string $name, private int $price) {}

    public function priceAfterDiscount(int $percent): float
    {
        return $this->price - (($this->price * $percent) / 100);
    }

    public function label(): string
    {
        return "{$this->name} - {$this->price}";
    }
}

$p = new Product('Áo', 200000);
echo $p->priceAfterDiscount(10), "\n";
echo $p->label(), "\n";
