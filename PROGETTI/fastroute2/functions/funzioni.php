<?php
// File: functions/funzioni.php

// ========== MITTENTI ==========
function listaMittenti($db) {
    return $db->query("SELECT * FROM mittente ORDER BY cognome, nome");
}

function aggiungiMittente($db, $dati) {
    $sql = "INSERT INTO mittente (nome, cognome, indirizzo, telefono, email) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    return $stmt->execute([$dati['nome'], $dati['cognome'], $dati['indirizzo'],
        $dati['telefono'], $dati['email']]);
}

function aggiungiPuntiFedelta($db, $id_mittente) {
    $stmt = $db->prepare("UPDATE mittente SET punti_fedelta = punti_fedelta + 1 WHERE id_mittente = ?");
    return $stmt->execute([$id_mittente]);
}

// ========== DESTINATARI ==========
function listaDestinatari($db) {
    return $db->query("SELECT * FROM destinatario ORDER BY cognome, nome");
}

function aggiungiDestinatario($db, $dati) {
    $sql = "INSERT INTO destinatario (nome, cognome, indirizzo, telefono, email) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    return $stmt->execute([$dati['nome'], $dati['cognome'], $dati['indirizzo'],
        $dati['telefono'], $dati['email']]);
}

function trovaDestinatario($db, $id) {
    $stmt = $db->prepare("SELECT * FROM destinatario WHERE id_destinatario = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

// ========== SEDI ==========
function listaSedi($db) {
    return $db->query("SELECT * FROM sede ORDER BY nome");
}

// ========== PLICHI ==========

// Genera codice univoco per il plico
function generaCodicePlico() {
    return 'FR' . date('Ymd') . rand(1000, 9999);
}

function listaPlici($db) {
    return $db->query("SELECT p.*, 
                              m.nome as mittente_nome, m.cognome as mittente_cognome, m.email as mittente_email,
                              d.nome as destinatario_nome, d.cognome as destinatario_cognome,
                              s1.nome as sede_partenza, s2.nome as sede_arrivo
                       FROM plico p
                       JOIN mittente m ON p.id_mittente = m.id_mittente
                       JOIN destinatario d ON p.id_destinatario = d.id_destinatario
                       JOIN sede s1 ON p.id_sede_partenza = s1.id_sede
                       JOIN sede s2 ON p.id_sede_arrivo = s2.id_sede
                       ORDER BY p.data_ora_accettazione DESC");
}

function creaPlico($db, $dati, $id_personale) {
    $codice = generaCodicePlico();
    $sql = "INSERT INTO plico (codice_univoco, data_ora_accettazione, stato, 
            id_mittente, id_destinatario, id_sede_partenza, id_sede_arrivo, id_personale_accett) 
            VALUES (?, NOW(), 'In partenza', ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    return $stmt->execute([$codice, $dati['mittente'], $dati['destinatario'],
        $dati['sede_partenza'], $dati['sede_arrivo'], $id_personale]);
}

function spedisciPlico($db, $id_plico, $id_personale) {
    $sql = "UPDATE plico SET stato = 'In transito', data_ora_spedizione = NOW(), id_personale_sped = ? 
            WHERE id_plico = ? AND stato = 'In partenza'";
    $stmt = $db->prepare($sql);
    return $stmt->execute([$id_personale, $id_plico]);
}

function ritiraPlico($db, $id_plico, $id_personale) {
    // Prendo email del mittente prima
    $sql = "SELECT m.email, m.id_mittente FROM plico p 
            JOIN mittente m ON p.id_mittente = m.id_mittente 
            WHERE p.id_plico = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id_plico]);
    $mittente = $stmt->fetch();

    // Aggiorno stato
    $sql2 = "UPDATE plico SET stato = 'Ritirato', data_ora_ritiro = NOW(), id_personale_ritiro = ? 
             WHERE id_plico = ?";
    $stmt2 = $db->prepare($sql2);
    $result = $stmt2->execute([$id_personale, $id_plico]);

    if($result && $mittente) {
        aggiungiPuntiFedelta($db, $mittente->id_mittente);
        return $mittente->email;
    }
    return false;
}

function cercaPlicoPerCodice($db, $codice) {
    $stmt = $db->prepare("SELECT p.*, 
                                 m.nome as mittente_nome, m.cognome as mittente_cognome,
                                 d.nome as destinatario_nome, d.cognome as destinatario_cognome,
                                 s1.nome as sede_partenza, s2.nome as sede_arrivo
                          FROM plico p
                          JOIN mittente m ON p.id_mittente = m.id_mittente
                          JOIN destinatario d ON p.id_destinatario = d.id_destinatario
                          JOIN sede s1 ON p.id_sede_partenza = s1.id_sede
                          JOIN sede s2 ON p.id_sede_arrivo = s2.id_sede
                          WHERE p.codice_univoco = ?");
    $stmt->execute([$codice]);
    return $stmt->fetch();
}

function plichiRitiratiUltimiGiorni($db, $giorni) {
    $stmt = $db->prepare("SELECT COUNT(*) as totale FROM plico 
                          WHERE stato = 'Ritirato' 
                          AND data_ora_ritiro >= DATE_SUB(NOW(), INTERVAL ? DAY)");
    $stmt->execute([$giorni]);
    return $stmt->fetch()->totale;
}

// ========== PERSONALE ==========
function verificaLogin($db, $email, $password) {
    $stmt = $db->prepare("SELECT * FROM personale WHERE email = ?");
    $stmt->execute([$email]);
    $utente = $stmt->fetch();

    if($utente && password_verify($password, $utente->password_hash)) {
        return $utente;
    }
    return false;
}

function cambiaPassword($db, $id, $nuovaPassword) {
    $hash = password_hash($nuovaPassword, PASSWORD_DEFAULT);
    $stmt = $db->prepare("UPDATE personale SET password_hash = ?, primo_accesso = 0 WHERE id_personale = ?");
    return $stmt->execute([$hash, $id]);
}

function cambiaTema($db, $id, $tema) {
    $stmt = $db->prepare("UPDATE personale SET tema_background = ? WHERE id_personale = ?");
    return $stmt->execute([$tema, $id]);
}

function validaPassword($pwd) {
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $pwd);
}

// ========== RICHIESTE INFO ==========
function salvaRichiestaInfo($db, $dati) {
    $sql = "INSERT INTO richiesta_info (nome, email, messaggio) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    return $stmt->execute([$dati['nome'], $dati['email'], $dati['messaggio']]);
}

function listaRichiesteInfo($db) {
    return $db->query("SELECT * FROM richiesta_info ORDER BY data_richiesta DESC");
}
?>