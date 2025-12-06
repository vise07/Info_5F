<?php

echo getcwd();
echo '<br>';
echo DIRECTORY_SEPARATOR;
$path = getcwd();
echo is_file($path.DIRECTORY_SEPARATOR."testo.txt") ? "true" : "false";
echo '<br>';

echo is_dir($path.DIRECTORY_SEPARATOR."prova2") ? "true" : "false";
$items = scandir($path.DIRECTORY_SEPARATOR."prova2");
echo '<br>';
echo '<h1>file nella mia directory </h1>';
echo '<UL>';
foreach($items as $item) {
    if(($item!='.')&&($item!='..'))
    echo'<LI>'.$item.'</LI>';
}
echo '</UL>';

$file1 = fopen("testo.txt", "w");
    fwrite($file1, "Ciao a tutti");
fclose($file1);

