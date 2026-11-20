<?php
declare(strict_types=1);

// Viết selectionSort(array $arr): array sắp xếp tăng dần. Ý tưởng: với mỗi vị trí i , tìm phần tử nhỏ nhất
// ở đoạn từ i đến cuối, đổi nó về vị trí i . Thử với [64, 25, 12, 22, 11] và mảng rỗng.

// selectionSort
function selectionSort(array $arr): array
{
    $n = count($arr);

    for ($i = 0; $i < $n; $i++) {
        $minIndex = $i;
        
        for ($j = $i + 1; $j < $n; $j++) {
            if ($arr[$j] <  $arr[$minIndex]) {
                $minIndex = $j;
            }
        }

        if ($minIndex !== $i) {
            [$arr[$i], $arr[$minIndex]] = [$arr[$minIndex], $arr[$i]];
        }
    }

    return $arr;
}

function show(string $label, mixed $value): void
{
    echo $label . ': ' . json_encode($value, JSON_UNESCAPED_UNICODE) . "\n";
}

show("Selection Sort", selectionSort([64, 25, 12, 22, 11]));