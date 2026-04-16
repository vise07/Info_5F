<?php
session_start();
require_once 'DatabaseConn.php';
$dbconfig = require 'configuration/DBconfiguration.php';
require_once 'function/funzioni_db.php';

$db = DatabaseConn::getDB($dbconfig);
if (is_null($db)) exit("Errore database");

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$stato_info = '';
$plico = null;

if (isset($_POST['btn_cerca'])) {
    $codice = $_POST['codice'];
    $plico = getPlicoByCodice($db, $codice);

    if ($plico) {
        if ($plico->data_ora_ritiro) {
            $stato = "ritirato";
            $stato_class = "status-ritirato";
            $stato_info = "Il pacco è stato ritirato il " . $plico->data_ora_ritiro;
        } elseif ($plico->data_ora_spedizione) {
            $stato = "in transito";
            $stato_class = "status-transito";
            $stato_info = "Il pacco è stato spedito il " . $plico->data_ora_spedizione . " ed è in viaggio verso " . $plico->sede_arrivo_nome;
        } else {
            $stato = "in partenza";
            $stato_class = "status-partenza";
            $stato_info = "Il pacco è stato accettato il " . $plico->data_ora_accettazione . " presso " . $plico->sede_partenza_nome;
        }
    } else {
        $stato_info = "<b class='msg-err'>Codice plico non trovato!</b>";
    }
}

require_once 'header.php';
?>

    <h1>🔍 Verifica Stato Plico</h1>

    <form action="verifica_stato.php" method="POST">
        <label>Inserisci Codice Plico:</label>
        <input type="text" name="codice" placeholder="Es: FR202412011234" required>
        <button type="submit" name="btn_cerca">Cerca</button>
    </form>

<?php if ($plico): ?>
    <div style="margin-top: 30px; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h2>Dettagli Plico</h2>
        <p><strong>Codice:</strong> <?php echo htmlspecialchars($plico->codice_univoco); ?></p>
        <p><strong>Mittente:</strong> <?php echo htmlspecialchars($plico->mittente_nome . ' ' . $plico->mittente_cognome); ?></p>
        <p><strong>Destinatario:</strong> <?php echo htmlspecialchars($plico->destinatario_nome . ' ' . $plico->destinatario_cognome); ?></p>
        <p><strong>Da:</strong> <?php echo htmlspecialchars($plico->sede_partenza_nome . ' - ' . $plico->sede_partenza_citta); ?></p>
        <p><strong>A:</strong> <?php echo htmlspecialchars($plico->sede_arrivo_nome . ' - ' . $plico->sede_arrivo_citta); ?></p>
        <p><strong>Stato:</strong> <span class="status <?php echo $stato_class; ?>"><?php echo ucfirst($stato); ?></span></p>
        <p><?php echo $stato_info; ?></p>
    </div>
<?php elseif (isset($_POST['btn_cerca']) && !$plico): ?>
    <?php echo $stato_info; ?>
<?php endif; ?>

<?php
require_once 'footer.php';
?>