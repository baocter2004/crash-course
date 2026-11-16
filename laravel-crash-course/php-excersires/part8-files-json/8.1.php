<?php
declare(strict_types=1);

$path = __DIR__ . '/note.txt';

file_put_contents($path, "Dòng 1\n");
file_put_contents($path, "Dòng 2\n", FILE_APPEND);
echo file_get_contents($path);
echo "---\n";

file_put_contents($path, "Làm lại\n");
echo file_get_contents($path);
unlink($path);