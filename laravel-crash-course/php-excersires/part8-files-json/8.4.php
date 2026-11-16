<?php
declare(strict_types=1);

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

// Cho sẵn hàm seedCsv($path) tạo file mẫu (xem đáp án để chép). Viết hàm loadExpenses(string $path):
// array đọc CSV thành mảng các mảng kết hợp, key lấy từ dòng tiêu đề, amount ép về int . Nếu file không
// tồn tại thì ném RuntimeException . In ra số dòng dữ liệu và một dòng đầu tiên dạng JSON.

define('CSV_PATH', __DIR__ . '/expenses.csv');

seedCsv(CSV_PATH);

function loadExpenses(string $path)
{
    if (!file_exists($path)) {
        throw new RuntimeException('Không Tìm Thấy File' . CSV_PATH);
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

$rows = loadExpenses(CSV_PATH);
echo count($rows), "\n";
echo json_encode($rows[0], JSON_UNESCAPED_UNICODE), "\n";
var_dump($rows[0]['amount']);

unlink(CSV_PATH);