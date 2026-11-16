<?php
declare(strict_types=1);
$path = __DIR__ . '/lines.txt';

file_put_contents($path, "một\nhai\nba\n\nnăm\n");

$handle = fopen($path, 'r');
$n = 0;
while (($line = fgets($handle)) !== false) {
    $n++;
    echo $n, ': ', rtrim($line, "\r\n"), "\n";
}
fclose($handle);

echo "---\n";

$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
echo count($lines), "\n";
echo json_encode($lines, JSON_UNESCAPED_UNICODE), "\n";

unlink($path);