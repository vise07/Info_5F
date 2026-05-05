<?php
// File: views/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$tema = $_SESSION['tema_background'] ?? 'light';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastRoute - Corriere Espresso</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="theme-<?= $tema ?>">
<div class="navbar">
    <a href="index.php?page=home">🏠 Home</a>
    <?php if(isset($_SESSION['id_personale'])): ?>
        <a href="index.php?page=dashboard">📊 Dashboard</a>
        <a href="index.php?page=gestione_plichi">📦 Operazioni</a>
        <a href="index.php?page=nuovo_mittente">👤 Nuovo Mittente</a>
        <a href="index.php?page=nuovo_destinatario">📝 Nuovo Destinatario</a>
        <a href="index.php?page=lista_destinatari">📋 Lista Destinatari</a>
        <a href="index.php?page=verifica_stato">🔍 Verifica Plico</a>
        <a href="index.php?page=profilo">⚙️ Profilo</a>
        <a href="index.php?page=logout">🚪 Esci</a>
    <?php else: ?>
        <a href="index.php?page=login">🔐 Accesso Staff</a>
    <?php endif; ?>
</div>
<div class="container">