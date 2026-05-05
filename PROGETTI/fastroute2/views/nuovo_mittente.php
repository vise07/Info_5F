<?php
// File: views/nuovo_mittente.php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../functions/funzioni.php';

if(!isset($_SESSION['id_personale'])) {
    header("Location: index.php?page=login");
    exit;
}

$msg_success = '';
$msg_error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dati = [
        'nome' => $_POST['nome'],
        'cognome' => $_POST['cognome'],
        'indirizzo' => $_POST['indirizzo'],
        'telefono' => $_POST['telefono'],
        'email' => $_POST['email']
    ];

    if(aggiungiMittente($db, $dati)) {
        $msg_success = "Mittente registrato con successo!";
    } else {
        $msg_error = "Errore: email già esistente o dati non validi.";
    }
}
?>
<div class="card">
    <h1>👤 Registra Nuovo Mittente</h1>

    <?php if($msg_success): ?>
        <div class="alert alert-success"><?= $msg_success ?></div>
    <?php endif; ?>
    <?php if($msg_error): ?>
        <div class="alert alert-error"><?= $msg_error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-row">
            <div class="form-group">
                <label>Nome *</label>
                <input type="text" name="nome" required>
            </div>
            <div class="form-group">
                <label>Cognome *</label>
                <input type="text" name="cognome" required>
            </div>
        </div>

        <div class="form-group">
            <label>Indirizzo *</label>
            <input type="text" name="indirizzo" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Telefono *</label>
                <input type="tel" name="telefono" required>
            </div>
            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="email" required>
            </div>
        </div>

        <button type="submit">Registra Mittente</button>
    </form>
</div>