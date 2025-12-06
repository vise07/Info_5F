<?php

echo 'ciao mondo 3';
echo '<br>';
echo 'Buongiorno a tutti';
echo '<br>';
$var = 10;
echo 'il valore della variabile e '.$var;
echo '<br>';
var_dump($var);
$var2 = 2.50;
echo 'il valore della variabile e '.$var;
echo '<br>';
var_dump($var2);
echo '<br>';
echo M_PI;
echo '<br>';
echo PHP_INT_MAX;
echo PHP_INT_MIN;

if($var2>5)
    echo 'confrontoeffettuato';
else echo 'ciao';
$vett1=[];
$vett=[10,20,30];
echo '<br>';
echo 'Visualizza 1 elemento vettore';
echo $vett[0];
echo '<br>';
echo 'Conteggio elementi del vettore';
$n=count($vett);
echo $n;
echo '<br>';
echo 'Visualizzo elementi del vettore con il ciclo for';
for($i=0;$i<$n;$i++)
    echo " $vett[$i]";
echo '<br>';
echo 'Visualizzo elementi del vettore con print_r';
print_r($vett);
$vett2=[10,20,30,'a','b'];

$studente =[
    "nome" => "Marco",
    "eta" => 18
];

echo $studente["nome"];

$studente["cognome"] = "Bianchi";

foreach($studente as $chiave => $valore){
    echo "$chiave: $valore <br>";
}

echo "vattore associativo annidato";
echo '<br>';
$studenti=[
    "studente1"=>[
        "nome" => "Gigi",
        "voto" => 7
    ],
    "studente2"=>[
        "nome" => "Luca",
        "voto" => 8
    ]
];

echo $studenti["studente2"]['nome'];
echo $studenti["studente2"]['voto'];

$config =[
    "databases" => "mio_db",
    "utente" => "amin",
    "password" => "12345"
];

if(array_key_exists("nome",$studente))
    echo "chiave trovata";
else echo "chiave non trovata";
echo '<br>';
$chiavi = array_keys($studente);
var_dump($chiavi);
echo '<br>';
$valori = array_values($studente);
var_dump($valori);
echo '<br>';
echo "$valori[1]";

isset($n);
if(isset($a))
    echo "esiste";
else echo "non esiste";

echo "<br>";
