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

$msg_success = '';
$msg_error = '';

if (isset($_POST['btn_ritira'])) {
    $id_plico = (int)$_POST['id_plico'];

    $plico = getPlicoById($db, $id_plico);

    if (registraRitiro($db, $id_plico, $_SESSION['user_id'])) {
        aggiornaPuntiFedelta($db, $plico->id_mittente);
        inviaEmailConferma($plico->mittente_email, $plico->mittente_nome, $plico->mittente_cognome, $plico->codice_univoco);

        $msg_success = "<b class='msg-ok'>Ritiro registrato con successo! Il mittente ha ricevuto un punto fedeltà.</b><br>";
    } else {
        $msg_error = "<b class='msg-err'>Errore: il plico è già stato ritirato o non esiste!</b><br>";
    }
}

$plici_da_ritirare = getPliciDaRitirare($db);

require_once 'header.php';
?>

    <h1>✅ Registra Ritiro</h1>

<?php echo $msg_success; ?>
<?php echo $msg_error; ?>

<?php if ($plici_da_ritirare->rowCount() > 0): ?>
    <form action="ritira_plico.php" method="POST">
        <label>Seleziona Plico da Ritirare:</label>
        <select name="id_plico" required>
            <?php while($p = $plici_da_ritirare->fetch()): ?>
                <option value="<?php echo $p->id_plico; ?>">
                    <?php echo htmlspecialchars($p->codice_univoco . ' - ' . $p->mittente . ' → ' . $p->destinatario . ' (Sede: ' . $p->sede_arrivo . ')'); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit" name="btn_ritira">Registra Ritiro</button>
    </form>
<?php else: ?>
    <p>Nessun plico in attesa di ritiro.</p>
<?php endif; ?>

<?php
require_once 'footer.php';
?>