<?php
// File: public/index.php
session_start();

$page = $_GET['page'] ?? 'home';

// Pagine pubbliche
$pagine_pubbliche = ['home', 'login', 'logout'];

// Pagine che richiedono autenticazione
$pagine_protette = ['dashboard', 'profilo', 'gestione_plichi', 'nuovo_mittente',
    'nuovo_destinatario', 'lista_destinatari', 'verifica_stato'];

// Controllo autenticazione per pagine protette
if(in_array($page, $pagine_protette) && !isset($_SESSION['id_personale'])) {
    header("Location: index.php?page=login");
    exit;
}

// Includi la vista corrispondente
$view_file = __DIR__ . '/../views/' . $page . '.php';

if(file_exists($view_file)) {
    include __DIR__ . '/../views/header.php';
    include $view_file;
    include __DIR__ . '/../views/footer.php';
} else {
    include __DIR__ . '/../views/header.php';
    include __DIR__ . '/../views/errore.php';
    include __DIR__ . '/../views/footer.php';
}
?>