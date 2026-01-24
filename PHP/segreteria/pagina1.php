<?php
?>

<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Pagina 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form method="POST" action="pagina2.php">
    <h1>Attivazione corsi</h1>

    <label for="corsi">Quanti corsi vuoi attivare?</label><br>
    <input type="number" name="corsi" min="1" max="10" required><br><br>

    <button type="submit">Invia</button>
</form>

</body>
</html>
