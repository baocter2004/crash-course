<?php
declare(strict_types=1);

// Viết bubbleSort(array $arr, bool $desc = false): array : sắp xếp mảng số tăng dần (mặc định) hoặc
// giảm dần (khi $desc = true ), không dùng hàm sort có sẵn. Chỉ dùng một chỗ so sánh cho cả hai hướng.
// Thử với [5, 2, 9, 1, 7] , mảng rỗng và mảng [3] .

// BubbleSort
function bubbleSort(array $arr, bool $desc = false): array
{
    $n = count($arr);

    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n - 1; $j++) {
            $outOfOrder = $desc ? $arr[$j] < $arr[$j + 1] : $arr[$j] > $arr[$j + 1];
            if ($outOfOrder) {
                [$arr[$j], $arr[$j + 1]] = [$arr[$j + 1], $arr[$j]];
            }
        }
    }

    return $arr;
}

function show(string $label, mixed $value): void
{
    echo $label . ': ' . json_encode($value, JSON_UNESCAPED_UNICODE) . "\n";
}

show('Tang dan', bubbleSort([5, 2, 9, 1, 7]));
show('Giam dan', bubbleSort([5, 2, 9, 1, 7], true));
show('Mang rong', bubbleSort([]));
show('Mot phan tu', bubbleSort([3]));