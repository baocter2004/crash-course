<?php
declare(strict_types=1);

$name = 'Bao';
$age = 20;

echo 'Xin chào $name', "\n"; // Xin chào $name
echo "Xin chào $name", "\n"; // Xin chào Bao
echo "Năm sau {$name} sẽ " . ($age + 1) . " tuổi", "\n"; // Năm sau Bao sẽ 21 tuổi
echo 'Dòng 1\nDòng 2', "\n"; // Dòng 1\nDòng 2
echo "Dòng 1\nDòng 2", "\n"; // Dòng 1 Dong 2