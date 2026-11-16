<?php
declare(strict_types=1);

// Dựa vào dữ liệu đọc từ CSV ở bài 8.4, viết hàm report(array $rows): array trả về mảng gồm:
// total : tổng chi (dùng array_reduce )
// byCategory : tổng chi theo từng danh mục, sắp giảm dần (dùng ??= rồi arsort )
// top : tên danh mục chi nhiều nhất (dùng array_key_first )
// In kết quả bằng json_encode . Kết quả với dữ liệu mẫu: tổng 3190000 , top là rent .
// Kết quả :

// {"total":3190000,"byCategory":{"rent":3000000,"food":140000,"transport":50000},"top":"rent"}

function seedCsv(string $path): void
{
    $handle = fopen($path, 'w');
    fputcsv($handle, ['date', 'category', 'amount', 'note']);
    fputcsv($handle, ['2026-10-01', 'food', 45000, 'ăn trưa, cà phê']);
    fputcsv($handle, ['2026-10-02', 'transport', 30000, 'xăng']);
    fputcsv($handle, ['2026-10-03', 'rent', 3000000, 'tiền phòng']);
    fputcsv($handle, ['2026-10-04', 'food', 60000, 'ăn tối']);
    fputcsv($handle, ['2026-10-05', 'transport', 20000, 'grab']);
    fputcsv($handle, ['2026-10-06', 'food', 35000, 'bún bò']);
    fclose($handle);
}

$path = __DIR__ . '/expenses2.csv';
seedCsv($path);

// loadExpense
function loadExpense(string $path)
{
    if (!file_exists($path)) {
        throw new RuntimeException('Không tìm thấy file: ' . $path);
    }

    $handle = fopen($path, 'r');
    $header = fgetcsv($handle);
    $rows = [];

    while (($data = fgetcsv($handle)) !== false) {
        $row = array_combine($header, $data);
        $row['amount'] = (int) $row['amount'];
        $rows[] = $row;
    }

    fclose($handle);
    return $rows;
}

function report(array $rows): array
{
    $total = array_reduce($rows, fn($carry, $row) => $carry + $row['amount'], 0);
    $byCategory = [];
    foreach ($rows as $row) {
        $byCategory[$row['category']] ??= 0;
        $byCategory[$row['category']] += $row['amount'];
    }

    arsort($byCategory);

    return [
        'total' => $total,
        'byCategory' => $byCategory,
        'top' => array_key_first($byCategory),
    ];
}

echo json_encode(report(loadExpense($path)), JSON_UNESCAPED_UNICODE), "\n";
unlink($path);