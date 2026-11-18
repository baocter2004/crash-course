<?php
declare(strict_types=1);

// Exception : try, catch, finally

// Viết hàm readOrFail(string $path): string ném RuntimeException('Không tìm thấy file: ...')
// (dùng basename ) nếu file không tồn tại, ngược lại trả nội dung file.
// Gọi hàm với file không tồn tại bên trong try/catch (RuntimeException $e) , in Lỗi: ... . Thêm finally
// in Đã thửđọc file . Gọi tiếp với một file có thật (tạo tạm bằng file_put_contents ) và in nội dung.

function readOrFail(string $path): string
{
    if (!file_exists($path)) {
        throw new RuntimeException("Không tìm thấy file: " . basename($path));
    }
    return file_get_contents($path);
}

// test file khong ton tai
try {
    echo readOrFail(__DIR__ . "/khong-ton-tai.csv");
} catch (RuntimeException $e) {
    echo 'Lỗi: ', $e->getMessage(), "\n";
} finally {
    echo 'Đã thử đọc file', "\n";
}

// test file thuc su ton tai
$real = __DIR__ . '/real.txt';
file_put_contents($real, "xin chào\n");

try {
    echo readOrFail($real);
} catch (RuntimeException $e) {
    echo 'Lỗi: ', $e->getMessage(), "\n";
} finally {
    echo 'Đã thử đọc file', "\n";
}

unlink($real);