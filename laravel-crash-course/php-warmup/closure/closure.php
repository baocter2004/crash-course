<?php
declare(strict_types=1);

// Closure

// closure là một hàm không tên , lưu được vào biến và truyền đi như một giá trị
$greet = function (string $name): string {
    return "Xin chào $name \n";
};

echo $greet('AN');

// closure không tự thấy biến bên ngoài
$rate = 1.1;
// $f = function (int $x) {
//     return $x * $rate;
// };

// sử dụng use
$f = function (int $x) use ($rate) {
    return $x * $rate;
};

// Arrow function ( fn )

$arrowF = fn (int $x) => $x * $rate;

// Use (&$x) : bắt theo tham chiếu
// mặc định use sao chép giá trị. Thêm & thì closure dùng chính biến đó và sửa được nó
$count = 0;
$inc = function () use (&$count) {
    $count++;
};

$inc();
$inc();
echo $count . "\n";

// Closure làm tham số
function repeatTimes(int $n, callable $action): void
{
    for ($i = 1; $i <= $n; $i++)
    {
        $action($i);
    }
}

repeatTimes(3, fn (int $i) => print("lần $i\n"));

// Trả về closure ( hàm sinh hàm )
function multiplier(int $factor): Closure
{
    return fn (int $x) => $x * $factor;
}

$double = multiplier(2);
$triple = multiplier(3);

echo $double(5), "\n";
echo $triple(5), "\n";
