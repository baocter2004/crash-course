<?php
declare(strict_types=1);

$name = 'Bao';
$age = 20;

// Noi chuoi bang toan tu .
echo 'Toi la ' . $name . ', ' . $age . ' tuoi, hoc php' . PHP_EOL;

// Noi suy bien trong nhay kep
echo "Toi la {$name}, {$age} tuoi, hoc php \n";

// Ham sprintf() voi %s va %d
echo sprintf('Toi la %s, %d tuoi, hoc php', $name, $age) . PHP_EOL;