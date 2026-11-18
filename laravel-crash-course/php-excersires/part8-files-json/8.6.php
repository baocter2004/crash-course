<?php
declare(strict_types=1);

// Từ báo cáo ở bài 8.5, ghi ra file report.json định dạng đẹp (xuống dòng thụt lề) và giữ nguyên tiếng Việt
// (không bị \u... ). Sau đó đọc file ngược lại bằng json_decode thành mảng và in total cùng top . In thêm
// nội dung file report.json .
// Để thấy rõ tiếng Việt, thêm key 'ghiChu' => 'Tổng kết tháng 10' vào mảng báo cáo.

$report = [
    'total' => 3190000,
    'byCategory' => ['rent' => 3000000, 'food' => 140000, 'transport' => 50000],
    'top' => 'rent',
    'ghiChu' => 'Tổng kết tháng 10',
];

$path = __DIR__ . 'report.json';

file_put_contents(
    $path,
    json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

echo file_get_contents($path), "\n";

$back = json_decode(file_get_contents($path), true);
echo $back['total'], "\n";
echo $back['top'], "\n";
unlink($path);