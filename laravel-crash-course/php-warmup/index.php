<?php
declare(strict_types=1);

$name = 'Bao';
const MAX = 10;

echo 'Xin chào $name', "\n";
echo "Xin chào $name", "\n";
echo 'Xin ' . 'chào', "\n";

var_dump(0 == 'abc');
var_dump('1e3' == '1000');
var_dump('1e3' === '1000');

$user = null;
echo $user?->name ?? 'khách', "\n";

$status = 404;
echo match ($status) {
    200, 201 => 'success',
    404      => 'not found',
    default  => 'unknown',
}, "\n";                              // not found