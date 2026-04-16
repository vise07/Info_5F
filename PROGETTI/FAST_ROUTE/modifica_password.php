<?php
session_start();
require_once 'DatabaseConn.php';
$dbconfig = require 'configuration/DBconfiguration.php';
require_once 'function/funzioni_db.php';

$db = DatabaseConn::getDB($dbconfig);
if (is_null($db)) exit("Errore database");

// Verifica login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$msg_error = '';
$msg_success = '';

if (isset($_POST['btn_modifica'])) {
    $nuova_password = $_POST['nuova_password'];
    $conferma_password = $_POST['conferma_password'];

    if ($nuova_password !== $conferma_password) {
        $msg_error = "<b class='msg-err'>Le password non coincidono!</b><br>";
    } elseif (!validaPassword($nuova_password)) {
        $msg_error = "<b class='msg-err'>La password deve avere almeno 8 caratteri, una maiuscola, una minuscola, un numero e un carattere speciale!</b><br>";
    } else {
        $password_hash = password_hash($nuova_password, PASSWORD_DEFAULT);
        modificaPassword($db, $_SESSION['user_id'], $password_hash);
        $_SESSION['primo_accesso'] = 0;
        $msg_success = "<b class='msg-ok'>Password modificata con successo!</b><br>";

        // Redirect dopo 2 secondi
        header("refresh:2;url=dashboard.php");
    }
}

require_once 'header.php';
?>

    <h1>🔒 Modifica Password</h1>

<?php if ($_SESSION['primo_accesso']): ?>
    <div class="msg-err" style="background:#fff3cd; color:#856404;">
        ⚠️ Attenzione: questo è il tuo primo accesso. Devi modificare la password.
    </div>
<?php endif; ?>

<?php echo $msg_error; ?>
<?php echo $msg_success; ?>

    <form action="modifica_password.php" method="POST">
        <label>Nuova Password:</label>
        <input type="password" name="nuova_password" required>
        <small>Almeno 8 caratteri, una maiuscola, una minuscola, un numero, un carattere speciale</small>

        <label>Conferma Password:</label>
        <input type="password" name="conferma_password" required>

        <button type="submit" name="btn_modifica">Modifica Password</button>
    </form>

<?php
require_once 'footer.php';
?>