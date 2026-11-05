<?php
declare(strict_types=1);

// dùng match để in ra nhãn của http code
function httpLabel(int $code): string
{
    return match ($code) {
        200, 201 => 'Thành công',
        301, 302 => 'Chuyển hướng',
        404 => 'Không tìm thấy',
        500 => 'Lỗi server',
        default => 'Không xác định'
    };
}


// Thành công
echo httpLabel(200), "\n"; // Thành công
// Chuyển hướng
echo httpLabel(301), "\n"; // Chuyển hướng
// Không tìm thấy
echo httpLabel(404), "\n"; // Không tìm thấy
// Lỗi server
echo httpLabel(500), "\n"; // Lỗi server
// Không xác định
echo httpLabel(123), "\n"; // Không xác định