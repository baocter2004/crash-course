<?php
declare(strict_types=1);

$tags = ['php', 'laravel'];

// add composer
$tags[] = 'composer';
echo json_encode($tags) , "\n";

// print first item
echo $tags[0] . "\n";

// print count in arrays
echo count($tags) . "\n";

// print last item but do not use fixed index = 2
echo end($tags) . "\n";

// print yes or no for the question of whether the array contains 'laravel'
echo in_array('laravel', $tags) ? 'yes' : 'no', "\n";

// Join the whole array into a string, with the elements
// separated by commas and spaces
echo implode(', ',$tags);