<?php
// File: views/errore.php
$messaggio = $_SESSION['error_msg'] ?? 'Si è verificato un errore imprevisto.';
unset($_SESSION['error_msg']);
?>
<div class="card" style="text-align: center;">
    <h1>⚠️ Errore</h1>
    <div class="alert alert-error"><?= htmlspecialchars($messaggio) ?></div>
    <a href="javascript:history.back()" class="btn">Torna indietro</a>
    <a href="index.php?page=home" class="btn" style="background: #2c3e50;">Vai alla Home</a>
</div>