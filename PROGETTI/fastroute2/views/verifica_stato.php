<?php
// File: views/verifica_stato.php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../functions/funzioni.php';

if(!isset($_SESSION['id_personale'])) {
    header("Location: index.php?page=login");
    exit;
}

$plico = null;
$msg_error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codice = $_POST['codice_plico'] ?? '';
    $plico = cercaPlicoPerCodice($db, $codice);

    if(!$plico) {
        $msg_error = "Nessun plico trovato con codice: $codice";
    }
}
?>
<div class="card">
    <h1>🔍 Verifica Stato Plico</h1>

    <form method="POST">
        <div class="form-row">
            <div class="form-group" style="flex: 2;">
                <label>Codice Plico</label>
                <input type="text" name="codice_plico" placeholder="Es: FR202412151234" required>
            </div>
            <div class="form-group" style="flex: 0;">
                <label>&nbsp;</label>
                <button type="submit">Cerca</button>
            </div>
        </div>
    </form>

    <?php if($msg_error): ?>
        <div class="alert alert-error"><?= $msg_error ?></div>
    <?php endif; ?>

    <?php if($plico): ?>
        <div class="stato-card" style="margin-top: 2rem;">
            <h2>Dettagli Plico</h2>
            <p><strong>Codice:</strong> <?= $plico->codice_univoco ?></p>
            <p><strong>Mittente:</strong> <?= htmlspecialchars($plico->mittente_nome . ' ' . $plico->mittente_cognome) ?></p>
            <p><strong>Destinatario:</strong> <?= htmlspecialchars($plico->destinatario_nome . ' ' . $plico->destinatario_cognome) ?></p>
            <p><strong>Sede Partenza:</strong> <?= $plico->sede_partenza ?></p>
            <p><strong>Sede Arrivo:</strong> <?= $plico->sede_arrivo ?></p>
            <p><strong>Data Accettazione:</strong> <?= $plico->data_ora_accettazione ?></p>

            <div class="stato-badge <?= $plico->stato == 'In partenza' ? 'stato-partenza' : ($plico->stato == 'In transito' ? 'stato-transito' : 'stato-ritirato') ?>">
                📦 Stato: <?= $plico->stato ?>
            </div>

            <?php if($plico->stato == 'Ritirato'): ?>
                <p><strong>Data Ritiro:</strong> <?= $plico->data_ora_ritiro ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>