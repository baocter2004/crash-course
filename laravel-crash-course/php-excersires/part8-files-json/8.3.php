<?php
declare(strict_types=1);

// Viết hàm addExpense(string $path, string $date, string $category, int $amount, string $note):
// void ghi nối một dòng vào file CSV. Nếu file chưa tồn tại thì ghi dòng tiêu đề date,category,amount,note
// trước. Gọi 3 lần, ít nhất một note chứa dấu phẩy (ví dụ ăn trưa, cà phê ). In nội dung file bằng
// file_get_contents .

$path = __DIR__ . "/expenses.csv";

function addExpense(string $path, string $date, string $category, int $amount, string $note): void
{
    $isNew = !file_exists($path);
    $handle = fopen($path, "a");

    if ($isNew) {
        fputcsv($handle, ['date', 'category', 'amount', 'note']);
    }

    fputcsv($handle, [$date, $category, $amount, $note]);
    fclose($handle);
}

addExpense($path, '2026-10-01', 'food', 45000, 'ăn trưa, cà phê');
addExpense($path, '2026-10-02', 'transport', 30000, 'xăng');
addExpense($path, '2026-10-03', 'rent', 3000000, 'tiền phòng');
echo file_get_contents($path);
unlink($path);