<?php
// File: views/home.php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../functions/funzioni.php';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['invia_richiesta'])) {
    $dati = [
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'messaggio' => $_POST['messaggio']
    ];
    if(salvaRichiestaInfo($db, $dati)) {
        $msg_success = "Richiesta inviata con successo!";
    } else {
        $msg_error = "Errore nell'invio. Riprova.";
    }
}
?>
<div class="card">
    <h1>🚚 FastRoute - Corriere Espresso</h1>
    <p>Il tuo partner affidabile per spedizioni rapide in tutta Italia.</p>
    <p>✅ Tracciamento in tempo reale</p>
    <p>✅ Consegne garantite entro 24/48 ore</p>
    <p>✅ Programma fedeltà con punti</p>
</div>

<div class="card">
    <h2>📞 Richiedi informazioni</h2>
    <?php if(isset($msg_success)): ?>
        <div class="alert alert-success"><?= $msg_success ?></div>
    <?php endif; ?>
    <?php if(isset($msg_error)): ?>
        <div class="alert alert-error"><?= $msg_error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Nome e Cognome</label>
            <input type="text" name="nome" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Messaggio</label>
            <textarea name="messaggio" rows="4" required></textarea>
        </div>
        <button type="submit" name="invia_richiesta">Invia Richiesta</button>
    </form>
</div>