<?php
declare(strict_types=1);

function shippingFee(int $total): int {
    return match (true) {
        $total >= 500000 => 0,
        $total >= 200000 => 15000,
        $total < 200000 => 30000,
    };
}

// 100000
echo shippingFee(100000), "\n"; // 30000
// 200000
echo shippingFee(200000), "\n"; // 15000
// 450000
echo shippingFee(450000), "\n"; // 15000
// 500000
echo shippingFee(500000), "\n"; // 0