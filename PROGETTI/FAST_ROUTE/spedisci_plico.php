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

if (isset($_POST['btn_spedisci'])) {
    $id_plico = (int)$_POST['id_plico'];

    if (registraSpedizione($db, $id_plico, $_SESSION['user_id'])) {
        $msg_success = "<b class='msg-ok'>Spedizione registrata con successo!</b><br>";
    } else {
        $msg_error = "<b class='msg-err'>Errore: il plico è già stato spedito o non esiste!</b><br>";
    }
}

// Usa la funzione dal file funzioni_db.php
$plici_da_spedire = getPliciNonSpediti($db);

require_once 'header.php';
?>

    <h1>🚚 Registra Spedizione</h1>

<?php echo $msg_success; ?>
<?php echo $msg_error; ?>

<?php if ($plici_da_spedire->rowCount() > 0): ?>
    <form action="spedisci_plico.php" method="POST">
        <label>Seleziona Plico da Spedire:</label>
        <select name="id_plico" required>
            <?php while($p = $plici_da_spedire->fetch()): ?>
                <option value="<?php echo $p->id_plico; ?>">
                    <?php echo htmlspecialchars($p->codice_univoco . ' - Mittente: ' . $p->mittente . ' → ' . $p->destinatario); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit" name="btn_spedisci">Registra Spedizione</button>
    </form>
<?php else: ?>
    <p>Nessun plico in attesa di spedizione.</p>
<?php endif; ?>

<?php
require_once 'footer.php';
?>