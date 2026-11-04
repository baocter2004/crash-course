<?php
declare(strict_types=1);

// Cho $nums = [3, 1, 4, 1, 5, 9, 2, 6, 5] . In ra mỗi dòng một giá trị theo nhãn:
// sum : tổng
// max , min : lớn nhất, nhỏ nhất
// count : số phần tử
// unique : các giá trị không trùng (JSON, là mảng chứ không phải object)
// has4 : yes / no nếu có số 4
// index9 : vị trí của số 9 (dùng array_search )
// reverse : mảng đảo ngược (JSON)
// first3 : 3 phần tử đầu (JSON)
// merged : nối với [7, 8] (JSON)

$nums = [3, 1, 4, 1, 5, 9, 2, 6, 5];

// sum 
$sum = array_sum($nums);
echo "sum : $sum\n";

// max , min
$max = max($nums);
$min = min($nums);
echo "max : $max\n";
echo "min : $min\n";

// count
$count = count($nums);
echo "count : $count\n";

// unique
$unique = array_unique($nums);
echo "unique : ", json_encode(array_values($unique)), "\n";

// has4
$has4 = in_array(4, $nums) ? 'yes' : 'no';
echo "has4 : $has4\n";

// index9
$index9 = array_search(9, $nums);
echo "index9 : $index9\n";

// reverse
$reverse = array_reverse($nums);
echo "reverse : ", json_encode($reverse), "\n";

// first3
$first3 = array_slice($nums, 0, 3);
echo "first3 : ", json_encode($first3), "\n";

// merged
$merged = array_merge($nums, [7, 8]);
echo "merged : ", json_encode($merged), "\n";