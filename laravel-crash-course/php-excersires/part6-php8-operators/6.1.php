<?php
declare(strict_types=1);

// ?? khác ?

// Cho $settings = ['theme' => 'dark', 'perPage' => 0, 'lang' => null] . 
// In ra 6 dòng, mỗi dòng một giá trị:
// 1. theme với mặc định 'light' (dùng ?? )
// 2. perPage với mặc định 15 dùng ??
// 3. perPage với mặc định 15 dùng ?:
// 4. lang với mặc định 'vi' dùng ??
// 5. timezone (không có trong mảng) mặc định 'UTC' dùng ??
// 6. perPage dùng isset rồi in có hoặc không
// Hãy tự dự đoán dòng 2 và dòng 3 trước khi chạy.

$settings = ['theme' => 'dark', 'perPage' => 0, 'lang' => null];

echo $settings['theme'] ?? 'light', "\n"; // dark

echo $settings['perPage'] ?? 15, "\n"; // 0

echo $settings['perPage'] ?: 15, "\n"; // 15

echo $settings['lang'] ?? 'vi', "\n"; // vi

echo $settings['timezone'] ?? 'UTC', "\n"; // UTC

echo isset($settings['perPage']) ? 'có' : 'không', "\n"; // có


