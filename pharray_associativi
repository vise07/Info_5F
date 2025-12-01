<?php

// 1. array_keys() - Restituisce tutte le chiavi di un array
$array1 = ["a" => 1, "b" => 2, "c" => 3];
$keys = array_keys($array1);
echo "Chiavi dell'array: ";
print_r($keys);

// 2. array_values() - Restituisce tutti i valori di un array
$values = array_values($array1);
echo "Valori dell'array: ";
print_r($values);

// 3. array_key_exists() - Verifica se una chiave esiste in un array
if (array_key_exists("b", $array1)) {
    echo "La chiave 'b' esiste nell'array.\n";
} else {
    echo "La chiave 'b' NON esiste nell'array.\n";
}

// 4. isset() - Verifica se una variabile è definita e non è null
$var = 5;
if (isset($var)) {
    echo "La variabile \$var è definita.\n";
} else {
    echo "La variabile \$var NON è definita.\n";
}

// 5. in_array() - Verifica se un valore esiste in un array
if (in_array(2, $array1)) {
    echo "Il valore 2 esiste nell'array.\n";
} else {
    echo "Il valore 2 NON esiste nell'array.\n";
}

// 6. array_search() - Restituisce la chiave di un valore in un array
$keyOfValue = array_search(3, $array1);
echo "La chiave del valore 3 è: " . $keyOfValue . "\n";

// 7. unset() - Rimuove una variabile o una chiave di un array
unset($array1["b"]);
echo "Array dopo unset su chiave 'b': ";
print_r($array1);

// 8. array_merge() - Unisce due o più array
$array2 = ["d" => 4, "e" => 5];
$mergedArray = array_merge($array1, $array2);
echo "Array unito: ";
print_r($mergedArray);

// 9. asort() - Ordina un array in modo ascendente secondo i valori
asort($array1);
echo "Array ordinato con asort: ";
print_r($array1);

// 10. arsort() - Ordina un array in modo discendente secondo i valori
arsort($array2);
echo "Array ordinato con arsort: ";
print_r($array2);

// 11. ksort() - Ordina un array in modo ascendente secondo le chiavi
ksort($mergedArray);
echo "Array ordinato con ksort: ";
print_r($mergedArray);

// 12. krsort() - Ordina un array in modo discendente secondo le chiavi
krsort($mergedArray);
echo "Array ordinato con krsort: ";
print_r($mergedArray);

// 13. array_map() - Applica una funzione a ogni elemento di un array
$squaredArray = array_map(function($value) {
    return $value * $value;
}, $mergedArray);
echo "Array dopo array_map (eleva al quadrato): ";
print_r($squaredArray);

// 14. array_filter() - Filtra gli elementi di un array usando una funzione
$filteredArray = array_filter($mergedArray, function($value) {
    return $value > 3; // Filtra valori maggiori di 3
});
echo "Array dopo array_filter (valori > 3): ";
print_r($filteredArray);

// 15. array_walk() - Applica una funzione a tutti gli elementi di un array
array_walk($array2, function(&$value, $key) {
    $value *= 2; // Moltiplica ogni valore per 2
});
echo "Array dopo array_walk (valori * 2): ";
print_r($array2);

// 16. array_slice() - Estrae una porzione di un array
$slicedArray = array_slice($mergedArray, 1, 2); // Estrae 2 elementi a partire dalla posizione 1
echo "Array dopo array_slice (estratto 2 elementi): ";
print_r($slicedArray);

// 17. array_splice() - Rimuove e sostituisce porzioni di un array
array_splice($mergedArray, 1, 2, ["x" => 99, "y" => 100]);
echo "Array dopo array_splice (sostituito 2 elementi): ";
print_r($mergedArray);
