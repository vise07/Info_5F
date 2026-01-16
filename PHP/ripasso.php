<?php

$discipline = [
    "INFORMATICA" => [
        "C:/Utenti/Bob/Documenti/info1" => [
            "argomento" => "PHP",
            "mese" => 3
        ]
    ],
    "SISTEMI" => [
        "C:/Utenti/Bob/Documenti/sistemi1" => [
            "argomento" => "Reti",
            "mese" => 4
        ]
    ],
    "TPS" => [
        "C:/Utenti/Bob/Documenti/tps1" => [
            "argomento" => "Socket",
            "mese" => 5
        ]
    ]
];

function estraiArgomentoEMese($dati, $disciplina, $percorso) {
    if (isset($dati[$disciplina][$percorso])) {
        return $dati[$disciplina][$percorso]["argomento"] . " - " . $dati[$disciplina][$percorso]["mese"];
    }
    return "Non trovato";
}

function inserisciPercorso(&$dati, $disciplina, $percorso, $argomento, $mese) {
    $valide = ["INFORMATICA", "SISTEMI", "TPS"];
    if (!in_array($disciplina, $valide)) {
        return "Disciplina non valida";
    }
    if ($mese < 1 || $mese > 12) {
        return "Mese non valido";
    }
    if (isset($dati[$disciplina][$percorso])) {
        return "Percorso già esistente";
    }
    $dati[$disciplina][$percorso] = [
        "argomento" => $argomento,
        "mese" => $mese
    ];
    return "OK";
}

echo estraiArgomentoEMese($discipline, "TPS", "C:/Utenti/Bob/Documenti/tps1");
echo "<br>";
echo inserisciPercorso($discipline, "INFORMATICA", "C:/Utenti/Bob/Documenti/info2", "Array", 6);
