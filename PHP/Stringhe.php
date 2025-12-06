<?php

$testo = "  ciao mondo php  ";
$testoPulito = trim($testo);

echo "strlen: " . strlen($testo) . "<br>";
echo "strrev: " . strrev($testo) . "<br>";
echo "strtolower: " . strtolower($testo) . "<br>";
echo "strtoupper: " . strtoupper($testo) . "<br>";
echo "ucfirst: " . ucfirst($testoPulito) . "<br>";
echo "ucwords: " . ucwords($testoPulito) . "<br>";
echo "trim: '" . trim($testo) . "'<br>";
echo "ltrim: '" . ltrim($testo) . "'<br>";
echo "rtrim: '" . rtrim($testo) . "'<br>";

$array = explode(" ", $testoPulito);
echo "explode: ";
print_r($array);
echo "<br>";

echo "implode: " . implode("-", $array) . "<br>";

// str_replace
echo "str_replace (sostituisce 'php' con 'PHP!'): " . str_replace("php", "PHP!", $testoPulito) . "<br>";

// substr
echo "substr (prime 4 lettere): " . substr($testoPulito, 0, 4) . "<br>";

// strpos
echo "strpos ('mondo'): " . strpos($testoPulito, "mondo") . "<br>";

// strrpos
echo "strrpos ('o'): " . strrpos($testoPulito, "o") . "<br>";

// strstr
echo "strstr ('mondo'): " . strstr($testoPulito, "mondo") . "<br>";

// stristr (case-insensitive)
echo "stristr ('CIAO'): " . stristr($testoPulito, "CIAO") . "<br>";

// sprintf
$nome = "Marco";
$eta = 30;
echo "sprintf: " . sprintf("Mi chiamo %s e ho %d anni.", $nome, $eta) . "<br>";

// printf
echo "printf: ";
printf("Ciao %s, numero: %d<br>", "Utente", 123);

// number_format
$numero = 12345.6789;
echo "number_format: " . number_format($numero, 2, ",", ".") . "<br>";

// addslashes
$frase = "Lui disse: 'Ciao!'";
echo "addslashes: " . addslashes($frase) . "<br>";

// stripslashes
$fraseSlash = addslashes($frase);
echo "stripslashes: " . stripslashes($fraseSlash) . "<br>";
