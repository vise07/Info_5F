<?php
# server side

$var = "Buongiorno";

$materie = ["sistemi", "gpoi", "informatica"];

$x = 2;

$msg="messaggio per javascript";

$studenti = [
    [
        "nome" => "Mario",
        "cognome" => "Rossi",
        "media" => 7.5
    ],
    [
        "nome" => "Luigi",
        "cognome" => "Verdi",
        "media" => 8
    ],
    [
        "nome" => "Anna",
        "cognome" => "Bianchi",
        "media" => 7
    ]
];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    <p>ciao</p>

    <!--metodo più lento per visualizzare una variabile-->
    <p><?php echo $var?></p>

    <!--metodo più veloce per visualizzare una variabile-->
    <p><?=$var?></p>

    <p><?=$materie[0]?></p>


    <?php foreach ($materie as $element):?>

    <hr>

    <p><?=$element?></p>

    <?php endforeach;?>

    <?php if ($x == 2): ?>
        <p>true</p>
    <?php else: ?>
        <p>false</p>
    <?php endif; ?>

    <button id="bottone"> Premi o sei nero </button>

    <table border="2">
        <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Media</th>
        </tr>

        <?php foreach ($studenti as $studente): ?>
            <tr>
                <td><?= $studente["nome"] ?></td>
                <td><?= $studente["cognome"] ?></td>
                <td><?= $studente["media"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>


    <script> message= <?=json_encode($msg)?></script>
    <script src = 'interaction.js'></script>
</body>
</html>
