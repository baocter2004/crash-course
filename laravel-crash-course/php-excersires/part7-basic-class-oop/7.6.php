<?php
declare(strict_types=1);

final class Item
{
    public function __construct(
        public readonly string $name,
        public readonly int $price,
        public readonly int $quantity,
    ) {
    }
}

class Cart
{
    public function __construct(
        private array $items = [],
    ) {
    }

    public function add(Item $item): void
    {
        $this->items[] = $item;
    }

    public function total(): int
    {
        return array_reduce(
            $this->items,
            fn($carry, Item $item) => $carry + ($item->price * $item->quantity),
            0
        );
    }

    public function names(): array
    {
        $items = array_map(fn($item) => $item->name, $this->items);
        sort($items);
        return $items;
    }
}

$cart = new Cart();
$cart->add(new Item('Áo', 200000, 2));
$cart->add(new Item('Quần', 350000, 1));
$cart->add(new Item('Mũ', 50000, 3));
echo $cart->total(), "\n";
echo json_encode($cart->names(), JSON_UNESCAPED_UNICODE), "\n";