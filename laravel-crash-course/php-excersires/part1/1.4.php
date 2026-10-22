<?php
declare(strict_types=1);

const TAX_RATE = 0.1;
define('SHOP_NAME', 'Cua Hang Php');

function priceWithTax(int $price): float
{
    return $price + ($price * TAX_RATE);
}

echo SHOP_NAME, "\n";
echo number_format(priceWithTax(200000), 0, ',', '.'), "\n";