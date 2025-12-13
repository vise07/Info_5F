<?php

/*
Test delle seguenti funzioni PHP:
fopen()
fclose()
fwrite()
fgets()
implode()
explode()
file_put_contents()
file_get_contents()
*/

$file = fopen("test.txt", "w");
fwrite($file, "Ciao\nCiao");
fclose($file);

$file = fopen("test.txt", "r");
echo fgets($file);
fclose($file);

$testo = file_get_contents("test.txt");
echo $testo;

file_put_contents("numeri.txt", "1,2,3,4,5");

$stringa = file_get_contents("numeri.txt");
$array = explode(",", $stringa);
echo implode(" - ", $array);
