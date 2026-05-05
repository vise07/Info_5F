<?php
// File: views/gestione_plichi.php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../functions/funzioni.php';
require_once __DIR__ . '/../mail/invio_mail.php';

if(!isset($_SESSION['id_personale'])) {
    header("Location: index.php?page=login");
    exit;
}

// Gestione azioni POST
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['azione'])) {
        switch($_POST['azione']) {
            case 'crea':
                $dati = [
                    'mittente' => $_POST['mittente'],
                    'destinatario' => $_POST['destinatario'],
                    'sede_partenza' => $_POST['sede_partenza'],
                    'sede_arrivo' => $_POST['sede_arrivo']
                ];
                if(creaPlico($db, $dati, $_SESSION['id_personale'])) {
                    $_SESSION['success_msg'] = "Plico accettato con successo!";
                } else {
                    $_SESSION['error_msg'] = "Errore nella creazione del plico.";
                }
                break;

            case 'spedisci':
                if(spedisciPlico($db, $_POST['id_plico'], $_SESSION['id_personale'])) {
                    $_SESSION['success_msg'] = "Spedizione registrata!";
                } else {
                    $_SESSION['error_msg'] = "Errore: plico non in stato di partenza.";
                }
                break;

            case 'ritira':
                $email = ritiraPlico($db, $_POST['id_plico'], $_SESSION['id_personale']);
                if($email) {
                    inviaMailConferma($email, $_POST['codice_plico']);
                    $_SESSION['success_msg'] = "Ritiro registrato! Email di conferma inviata al mittente.";
                } else {
                    $_SESSION['error_msg'] = "Errore nella registrazione del ritiro.";
                }
                break;
        }
        header("Location: index.php?page=gestione_plichi");
        exit;
    }
}

$mittenti = listaMittenti($db);
$destinatari = listaDestinatari($db);
$sedi = listaSedi($db);
$plichi = listaPlici($db);
?>
<div class="card">
    <h1>📦 Gestione Spedizioni</h1>

    <h2>➕ Accetta nuovo plico</h2>
    <form method="POST">
        <input type="hidden" name="azione" value="crea">

        <div class="form-row">
            <div class="form-group">
                <label>Mittente *</label>
                <select name="mittente" required>
                    <option value="">Seleziona mittente</option>
                    <?php foreach($mittenti as $m): ?>
                        <option value="<?= $m->id_mittente ?>"><?= htmlspecialchars($m->nome . ' ' . $m->cognome) ?> (Punti: <?= $m->punti_fedelta ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Destinatario *</label>
                <select name="destinatario" required>
                    <option value="">Seleziona destinatario</option>
                    <?php foreach($destinatari as $d): ?>
                        <option value="<?= $d->id_destinatario ?>"><?= htmlspecialchars($d->nome . ' ' . $d->cognome) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Sede Partenza *</label>
                <select name="sede_partenza" required>
                    <?php foreach($sedi as $s): ?>
                        <option value="<?= $s->id_sede ?>"><?= htmlspecialchars($s->nome . ' - ' . $s->citta) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Sede Arrivo *</label>
                <select name="sede_arrivo" required>
                    <?php foreach($sedi as $s): ?>
                        <option value="<?= $s->id_sede ?>"><?= htmlspecialchars($s->nome . ' - ' . $s->citta) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <button type="submit">Registra Accettazione</button>
    </form>
</div>

<div class="card">
    <h2>📋 Plici in gestione</h2>
    <div style="overflow-x: auto;">
        <table>
            <thead>
            <tr><th>Codice</th><th>Mittente</th><th>Destinatario</th><th>Sede Arrivo</th><th>Stato</th><th>Azioni</th></tr>
            </thead>
            <tbody>
            <?php foreach($plichi as $p): ?>
                <tr>
                    <td><strong><?= $p->codice_univoco ?></strong></td>
                    <td><?= htmlspecialchars($p->mittente_nome . ' ' . $p->mittente_cognome) ?></td>
                    <td><?= htmlspecialchars($p->destinatario_nome . ' ' . $p->destinatario_cognome) ?></td>
                    <td><?= $p->sede_arrivo ?></td>
                    <td>
                        <?php if($p->stato == 'In partenza'): ?>
                            <span style="color:#f39c12">⏳ In partenza</span>
                        <?php elseif($p->stato == 'In transito'): ?>
                            <span style="color:#3498db">🚚 In transito</span>
                        <?php else: ?>
                            <span style="color:#27ae60">✅ Ritirato</span>
                        <?php endif; ?>
                    </td>
                    <td class="action-buttons">
                        <?php if($p->stato == 'In partenza'): ?>
                            <form method="POST" style="display:inline">
                                <input type="hidden" name="azione" value="spedisci">
                                <input type="hidden" name="id_plico" value="<?= $p->id_plico ?>">
                                <button type="submit" class="btn-small btn-warning">🚚 Spedisci</button>
                            </form>
                        <?php endif; ?>

                        <?php if($p->stato == 'In transito'): ?>
                            <form method="POST" style="display:inline">
                                <input type="hidden" name="azione" value="ritira">
                                <input type="hidden" name="id_plico" value="<?= $p->id_plico ?>">
                                <input type="hidden" name="codice_plico" value="<?= $p->codice_univoco ?>">
                                <button type="submit" class="btn-small">✅ Ritirato</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>