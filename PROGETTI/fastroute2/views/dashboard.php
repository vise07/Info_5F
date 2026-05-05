<?php
// File: views/dashboard.php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../functions/funzioni.php';

if(!isset($_SESSION['id_personale'])) {
    header("Location: index.php?page=login");
    exit;
}

$plichi = listaPlici($db);
$richieste = listaRichiesteInfo($db);
$statistiche = null;

if(isset($_GET['giorni'])) {
    $giorni = (int)$_GET['giorni'];
    $statistiche = plichiRitiratiUltimiGiorni($db, $giorni);
}
?>
<div class="card">
    <h1>📊 Dashboard FastRoute</h1>
    <p>Benvenuto, <?= htmlspecialchars($_SESSION['email']) ?></p>

    <h2>📈 Statistiche</h2>
    <form method="GET" class="stats-form">
        <div class="form-group">
            <label>Plici ritirati negli ultimi</label>
            <input type="number" name="giorni" value="<?= $_GET['giorni'] ?? 7 ?>" min="1">
        </div>
        <button type="submit">Calcola</button>
    </form>

    <?php if($statistiche !== null): ?>
        <div class="alert alert-success" style="margin-top: 1rem;">
            📦 Totale plichi ritirati: <strong><?= $statistiche ?></strong>
        </div>
    <?php endif; ?>
</div>

<div class="card">
    <h2>📦 Tutte le Spedizioni</h2>
    <div style="overflow-x: auto;">
        <table>
            <thead>
            <tr><th>Codice</th><th>Mittente</th><th>Destinatario</th><th>Stato</th><th>Accettazione</th><th>Spedizione</th><th>Ritiro</th></tr>
            </thead>
            <tbody>
            <?php foreach($plichi as $p): ?>
                <tr>
                    <td><strong><?= $p->codice_univoco ?></strong></td>
                    <td><?= htmlspecialchars($p->mittente_nome . ' ' . $p->mittente_cognome) ?></td>
                    <td><?= htmlspecialchars($p->destinatario_nome . ' ' . $p->destinatario_cognome) ?></td>
                    <td>
                        <?php if($p->stato == 'In partenza'): ?>
                            <span style="color:#f39c12">⏳ In partenza</span>
                        <?php elseif($p->stato == 'In transito'): ?>
                            <span style="color:#3498db">🚚 In transito</span>
                        <?php else: ?>
                            <span style="color:#27ae60">✅ Ritirato</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $p->data_ora_accettazione ?></td>
                    <td><?= $p->data_ora_spedizione ?? '-' ?></td>
                    <td><?= $p->data_ora_ritiro ?? '-' ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <h2>✉️ Richieste Informazioni</h2>
    <div style="overflow-x: auto;">
        <table>
            <thead>
            <tr><th>Data</th><th>Nome</th><th>Email</th><th>Messaggio</th></tr>
            </thead>
            <tbody>
            <?php foreach($richieste as $r): ?>
                <tr>
                    <td><?= $r->data_richiesta ?></td>
                    <td><?= htmlspecialchars($r->nome) ?></td>
                    <td><?= htmlspecialchars($r->email) ?></td>
                    <td><?= nl2br(htmlspecialchars($r->messaggio)) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>