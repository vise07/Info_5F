<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>FORM</title>
</head>
<header>
    <a href="index.php">Home</a>
    <a href="form.php">Form</a>
    <a href="risultato.php">Risultato</a>
</header>
<body>

    <!--nome, cognome, data nascita, email, password, checkbox, drop down, list box multipla-->

    <h1>Inserisci dati:</h1><br>

    <form action="risultato.php" method="POST">

        <label for="nome">Nome</label>
        <input id="nome" type="text" name="nome"><br><br>

        <label for="cognome">Cognome</label>
        <input id="cognome" type="text" name="cognome"><br><br>

        <label for="data">Data di nascita</label>
        <input id="data" type="date" name="data"><br><br>

        <label for="email">Email</label>
        <input id="email" type="email" name="email"><br><br>

        <label for="password">Password</label>
        <input id="password" type="password" name="password"><br><br>

        <p>Generi di libri preferiti:</p>
        <input type="checkbox" name="generi[]" value="Fantasy"> Fantasy
        <input type="checkbox" name="generi[]" value="Giallo"> Giallo
        <input type="checkbox" name="generi[]" value="Horror"> Horror
        <input type="checkbox" name="generi[]" value="Romanzo"> Romanzo
        <br><br>

        <label for="libro">Libro preferito</label>
        <select id="libro" name="libro">
            <option value="Harry Potter">Harry Potter</option>
            <option value="Il Signore degli Anelli">Il Signore degli Anelli</option>
            <option value="1984">1984</option>
            <option value="Divina Commedia">Divina Commedia</option>
        </select><br><br>

        <label for="autori">Autori preferiti</label><br>
        <select id="autori" name="autori[]" multiple size="4">
            <option value="Rowling">J.K. Rowling</option>
            <option value="Tolkien">J.R.R. Tolkien</option>
            <option value="Orwell">George Orwell</option>
            <option value="Dante">Dante Alighieri</option>
        </select><br><br>

        <input type="submit" value="Invia">

    </form>
</body>
</html>
