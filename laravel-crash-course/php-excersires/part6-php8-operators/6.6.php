<?php
declare(strict_types=1);

$v = '1';
switch ($v) {
    case 1:
        echo 'switch khớp', "\n";
        break;
    default:
        echo 'switch không khớp', "\n";
}
// switch không so sánh kiểu dữ liệu nên là khớp

echo match ($v) {
    1 => 'match khớp',
    default => 'match không khớp',
}, "\n";

// match so sánh kiểu dữ liệu nên không khớp