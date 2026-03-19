<?php

$array = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $array = [
        "Nome" => $_POST["nome"] ?? "",
        "Cognome" => $_POST["cognome"] ?? "",
        "Data di nascita" => $_POST["data"] ?? "",
        "Email" => $_POST["email"] ?? "",
        "Password" => $_POST["password"] ?? "",
        "Libro preferito" => $_POST["libro"] ?? "",
        "Generi" => isset($_POST["generi"]) ? implode(", ", $_POST["generi"]) : "Nessuno",
        "Autori" => isset($_POST["autori"]) ? implode(", ", $_POST["autori"]) : "Nessuno"
    ];

}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>RISULTATO</title>
</head>
<header>
    <a href="index.php">Home</a>
    <a href="form.php">Form</a>
    <a href="risultato.php">Risultato</a>
</header>
<body>

    <h1>Risultato dati:</h1>

    <?php if(!empty($array)): ?>

        <table border="1">

            <tr>
                <?php foreach ($array as $key => $value): ?>
                    <th><?= $key ?></th>
                <?php endforeach; ?>
            </tr>

            <tr>
                <?php foreach ($array as $key => $valure): ?>
                    <td><?= $value ?></td>
                <?php endforeach; ?>
            </tr>

        </table>

    <?php else: ?>
        <p>Nessun dato inviato.</p>
    <?php endif; ?>

</body>
</html>
