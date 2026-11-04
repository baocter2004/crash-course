<?php
declare(strict_types=1);

// Với $numbers = [1, 2, 3, 4, 5, 6] : lấy các số lẻ, bình phương từng số, rồi cộng tất cả lại. Viết bằng ba
// hàm array_filter , array_map , array_reduce nối nhau, in kết quả.
// Kiểm tra bằng tay trước: 1² + 3² + 5² = 1 + 9 + 25 = 35 .

$numbers = [1, 2, 3, 4, 5, 6];

$squareOddNumbers = array_map(
    fn(int $number) => $number * $number,
    array_filter(
        $numbers,
        fn(int $number) => $number % 2 !== 0,
    )
);

$result = array_reduce(
    $squareOddNumbers,
    fn(int $carry, int $item) => $carry + $item,
    0
);

echo $result, "\n"; // 35