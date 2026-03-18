<?php
$utenti = [
    ["nome" => "Nicolo", "cognome" => "Zanfo69", "password" => "pedofilo"],
    ["nome" => "Riccardo", "cognome" => "Cappella", "password" => "lecca"],
];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuovo_nome = $_POST["nome"];
    $nuovo_cognome = $_POST["cognome"];
    $nuovo_password = $_POST["password"];
    $utenti [] = [
        "nome" => $nuovo_nome, "cognome" => $nuovo_cognome, "password" => $nuovo_password
    ];
}

$info = array_keys($utenti[0]);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" href="style.css">
    <title>FORM</title>
</head>
<body>

    <table>

        <tr>
            <?php foreach ($info as $item):?>
                <?php if ($item != "password"): ?>
                    <th>
                        <?= $item?>
                    </th>
                <?php endif; ?>
            <?php endforeach;?>
        </tr>

        <?php foreach ($utenti as $item):?>
            <tr>
                <td>
                    <?= $item["nome"]?>
                </td>
                <td>
                    <?= $item["cognome"]?>
                </td>
            </tr>
        <?php endforeach;?>

    </table>

</body>
</html>
