<?php
$data = date("Y-m-d");
$ora = date("H:i:s");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>INDEX</title>
</head>
<header>
    <a href="index.php">Home</a>
    <a href="form.php">Form</a>
    <a href="risultato.php">Risultato</a>
</header>
<body>

    <h1>Orario:</h1>
    <?= $data?>
    <?= $ora?>
    <br><br>
    <a href="form.php">Inserisci dati</a>

</body>
</html>
