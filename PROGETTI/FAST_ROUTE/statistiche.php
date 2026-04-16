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

$statistiche = null;
$giorni = 30;

if (isset($_POST['btn_statistiche'])) {
    $giorni = (int)$_POST['giorni'];
    $statistiche = getStatisticheRitirati($db, $giorni);
}

require_once 'header.php';
?>

    <h1>📈 Statistiche</h1>

    <form action="statistiche.php" method="POST">
        <label>Numero di plichi ritirati negli ultimi N giorni:</label>
        <input type="number" name="giorni" min="1" max="365" value="<?php echo $giorni; ?>" required>
        <button type="submit" name="btn_statistiche">Calcola</button>
    </form>

<?php if ($statistiche !== null): ?>
    <div style="margin-top: 30px; padding: 20px; background: #e8f0fe; border-radius: 8px; text-align: center;">
        <h2>Risultato</h2>
        <p style="font-size: 48px; font-weight: bold; margin: 20px 0;"><?php echo $statistiche; ?></p>
        <p>plicchi ritirati negli ultimi <strong><?php echo $giorni; ?></strong> giorni</p>
    </div>
<?php endif; ?>

<?php
require_once 'footer.php';
?>