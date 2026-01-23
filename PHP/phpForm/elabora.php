<?php
# $_post variabile globale, e' una superglobal (array associativo)
$nome = $_POST ["nome"] ?? "";
$cognome = $_POST ["cognome"] ?? "";
$email = $_POST ["email"] ?? "";
$password = $_POST ["password"] ?? "";
$eta = $_POST ["eta"] ?? "";
$sesso = $_POST ["sesso"] ?? "";
$corsi = $_POST ["corsi"] ?? [];
$citta = $_POST ["citta"] ?? "";
$lingua = $_POST ["lingua"] ?? "";
$area = $_POST ["area"] ?? "";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ELABORA</title>
</head>
<body>
    <p>Nome: <?=$nome?></p>
    <p>Cognome: <?=$cognome?></p>
    <p>Email: <?=$email?></p>
    <p>Password: <?=$password?></p>
    <p>Età: <?=$eta?></p>
    <p>Sesso: <?=$sesso?></p>
    <p>Corsi: <?=$corsi?></p>
    <p>Città: <?=$citta?></p>

</body>
</html>
