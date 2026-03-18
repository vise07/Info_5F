<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" href = "style.css">
    <title>FORM</title>
</head>
<body>

    <form action="index.php" method="POST">

        <label for = "nome">Inserisci il nome</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <label for = "cognome">Inserisci il cognome</label>
        <input type="text" id="cognome" name="cognome" required>
        <br>
        <label for = "password">Inserisci la password</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Invia dati</button>

    </form>

</body>
</html>
