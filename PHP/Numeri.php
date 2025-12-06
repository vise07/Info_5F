<?php

// Numero di base
$numero = -15.7;

// abs
echo "abs(-15.7): " . abs($numero) . "<br>";

// ceil
echo "ceil(4.3): " . ceil(4.3) . "<br>";

// floor
echo "floor(4.9): " . floor(4.9) . "<br>";

// round
echo "round(4.6): " . round(4.6) . "<br>";

// mt_rand
echo "mt_rand(1, 10): " . mt_rand(1, 10) . "<br>";

// rand
echo "rand(1, 10): " . rand(1, 10) . "<br>";

// min
echo "min(3, 9, -2): " . min(3, 9, -2) . "<br>";

// max
echo "max(3, 9, -2): " . max(3, 9, -2) . "<br>";

// sqrt
echo "sqrt(16): " . sqrt(16) . "<br>";

// pow
echo "pow(2, 4): " . pow(2, 4) . "<br>";

// intdiv
echo "intdiv(10, 3): " . intdiv(10, 3) . "<br>";

// number_format
echo "number_format(12345.678, 2, ',', '.'): " . number_format(12345.678, 2, ',', '.') . "<br>";

// is_numeric
echo "is_numeric('123'): " . (is_numeric("123") ? "true" : "false") . "<br>";

// is_int
$val1 = 10;
echo "is_int(10): " . (is_int($val1) ? "true" : "false") . "<br>";

// is_float
$val2 = 10.5;
echo "is_float(10.5): " . (is_float($val2) ? "true" : "false") . "<br>";

// intval
echo "intval('35.9'): " . intval("35.9") . "<br>";

// floatval
echo "floatval('35.9'): " . floatval("35.9") . "<br>";

// pi
echo "pi(): " . pi() . "<br>";

// log (logaritmo naturale)
echo "log(10): " . log(10) . "<br>";

// exp (e^x)
echo "exp(1): " . exp(1) . "<br>";
