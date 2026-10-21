<?php

declare(strict_types=1);

define('CSV_PATH', __DIR__ . '/expenses.csv');

function addExpense(string $date, string $category, int $amount, string $note): void
{
    $isNew = !file_exists(CSV_PATH);
    $handle = fopen(CSV_PATH, 'a');

    if ($isNew) {
        fputcsv($handle, ['date', 'category', 'amount', 'note']);
    }

    fputcsv($handle, [$date, $category, $amount, $note]);
    fclose($handle);
}

// addExpense('2026-10-01', 'food', 45000, 'ăn trưa, cà phê');
// addExpense('2026-10-02', 'transport', 30000, 'xăng');
// addExpense('2026-10-03', 'rent', 3000000, 'tiền phòng');
// addExpense('2026-10-04', 'food', 60000, 'ăn tối');
// addExpense('2026-10-05', 'transport', 20000, 'grab');
// addExpense('2026-10-06', 'food', 35000, 'bún bò');

function loadExpenses(): array
{
    if (!file_exists(CSV_PATH)) {
        throw new RuntimeException('Không tìm thấy file: ' . CSV_PATH);
    }

    $handle = fopen(CSV_PATH, 'r');
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

// print_r(loadExpenses());

function report(array $rows): array
{
    $total = array_reduce($rows, fn($carry, $row) => $carry + $row['amount'], 0);

    $byCategory = [];

    foreach ($rows as $row) {
        $byCategory[$row['category']] ??= 0;
        $byCategory[$row['category']] += $row['amount'];
    }

    arsort($byCategory);
    $top = array_key_first($byCategory);

    return [
        'total' => $total,
        'byCategory' => $byCategory,
        'top' => $top,
    ];
}

// print_r(report(loadExpenses()));

$report = report(loadExpenses());

file_put_contents(
    __DIR__ . '/report.json',
    json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

$back = json_decode(file_get_contents(__DIR__. '/report.json'), true);
echo $back['total'] . "\n";

try {
    $rows = loadExpenses();
} catch (RuntimeException $e) {
    echo 'Lỗi: ' . $e->getMessage() . "\n";
}
