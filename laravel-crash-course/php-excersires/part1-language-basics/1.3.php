<?php
declare(strict_types=1);

var_dump(0 == 'abc'); // false
var_dump('1e3' == '1000'); // true
var_dump('1e3' === '1000'); // false
var_dump(null == false); // true
var_dump('0' == false); // true
var_dump([] == false); // true
var_dump('abc' == 0); // false
var_dump(100 == '100'); // true
var_dump(100 === '100'); // false