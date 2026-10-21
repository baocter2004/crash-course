<?php

declare(strict_types=1);

function bubbleSort(array $arr, bool $desc = false): array
{
    $n = count($arr);

    do {
        $swapped = false;

        for ($i = 0; $i < $n - 1; $i++) {
            $outOfOrder = $desc ? $arr[$i] < $arr[$i + 1] : $arr[$i] > $arr[$i + 1];

            if ($outOfOrder) {
                [$arr[$i], $arr[$i + 1]] = [$arr[$i + 1], $arr[$i]];
                $swapped = true;
            }
        }
    } while ($swapped);

    return $arr;
}

function selectionSort(array $arr): array
{
    $n = count($arr);

    for ($i = 0; $i < $n - 1; $i++) {
        $minIndex = $i;

        for ($j = $i + 1; $j < $n; $j++) {
            if ($arr[$j] < $arr[$minIndex]) {
                $minIndex = $j;
            }
        }

        if ($minIndex !== $i) {
            [$arr[$i], $arr[$minIndex]] = [$arr[$minIndex], $arr[$i]];
        }
    }

    return $arr;
}

function stats(array $arr): array
{
    if ($arr === []) {
        return ['max' => null, 'min' => null, 'second' => null];
    }

    $max = $min = $arr[0];
    $second = null;

    foreach ($arr as $x) {
        if ($x > $max) {
            $second = $max;
            $max = $x;
        } elseif ($x !== $max && ($second === null || $x > $second)) {
            $second = $x;
        }

        if ($x < $min) {
            $min = $x;
        }
    }

    return ['max' => $max, 'min' => $min, 'second' => $second];
}

function binarySearch(array $sorted, int $target, int &$steps = 0): int
{
    $low = 0;
    $high = count($sorted) - 1;
    $steps = 0;

    while ($low <= $high) {
        $steps++;
        $mid = intdiv($low + $high, 2);

        if ($sorted[$mid] === $target) {
            return $mid;
        }

        if ($sorted[$mid] < $target) {
            $low = $mid + 1;
        } else {
            $high = $mid - 1;
        }
    }

    return -1;
}

function linearSearch(array $arr, int $target, int &$steps = 0): int
{
    $steps = 0;

    foreach ($arr as $i => $x) {
        $steps++;

        if ($x === $target) {
            return $i;
        }
    }

    return -1;
}

function pairsNested(array $arr, int $k): array
{
    $pairs = [];
    $n = count($arr);

    for ($i = 0; $i < $n; $i++) {
        for ($j = $i + 1; $j < $n; $j++) {
            if ($arr[$i] + $arr[$j] === $k) {
                $pairs[] = [$arr[$i], $arr[$j]];
            }
        }
    }

    return $pairs;
}

function pairsWithSum(array $arr, int $k): array
{
    $seen = [];
    $pairs = [];

    foreach ($arr as $x) {
        $need = $k - $x;

        if (isset($seen[$need])) {
            $pairs[] = [$need, $x];
        }

        $seen[$x] = true;
    }

    return $pairs;
}

function duplicates(array $arr): array
{
    $count = [];

    foreach ($arr as $x) {
        $count[$x] ??= 0;
        $count[$x]++;
    }

    return array_filter($count, fn ($c) => $c > 1);
}

function groupAnagrams(array $words): array
{
    $groups = [];

    foreach ($words as $word) {
        $letters = str_split($word);
        sort($letters);
        $groups[implode('', $letters)][] = $word;
    }

    return array_values($groups);
}

function isValidBrackets(string $s): bool
{
    $pairs = [')' => '(', ']' => '[', '}' => '{'];
    $stack = [];

    foreach (str_split($s) as $ch) {
        if (in_array($ch, $pairs, true)) {
            $stack[] = $ch;
            continue;
        }

        if (array_pop($stack) !== $pairs[$ch]) {
            return false;
        }
    }

    return $stack === [];
}

function show(string $label, mixed $value): void
{
    echo $label . ': ' . json_encode($value, JSON_UNESCAPED_UNICODE) . "\n";
}

show('3.1 bubble asc', bubbleSort([5, 2, 9, 1, 7]));
show('3.1 bubble desc', bubbleSort([5, 2, 9, 1, 7], true));
show('3.1 bubble empty', bubbleSort([]));
show('3.1 bubble one', bubbleSort([3]));

show('3.2 selection', selectionSort([64, 25, 12, 22, 11]));
show('3.2 selection empty', selectionSort([]));

show('3.4 stats', stats([5, 9, 2, 9, 7]));
show('3.4 stats same', stats([5, 5, 5]));
show('3.4 stats empty', stats([]));

$nums = range(1, 1000);
$binSteps = 0;
$linSteps = 0;
show('3.5 binary 777', binarySearch($nums, 777, $binSteps));
show('3.5 binary steps', $binSteps);
show('3.5 linear 777', linearSearch($nums, 777, $linSteps));
show('3.5 linear steps', $linSteps);
show('3.5 binary missing', binarySearch($nums, 5000));

show('3.6 nested', pairsNested([1, 5, 3, 7, 4, 6, 2], 8));
show('3.6 hash', pairsWithSum([1, 5, 3, 7, 4, 6, 2], 8));

show('3.7 duplicates', duplicates([1, 2, 2, 3, 3, 3, 4]));
show('3.7 duplicates str', duplicates(['a', 'b', 'a']));

show('3.8 anagram', groupAnagrams(['listen', 'silent', 'enlist', 'google', 'gogole', 'cat', 'act']));

show('3.9 ([]{})', isValidBrackets('([]{})'));
show('3.9 ([)]', isValidBrackets('([)]'));
show('3.9 ((', isValidBrackets('(('));
show('3.9 empty', isValidBrackets(''));
show('3.9 )(', isValidBrackets(')('));
