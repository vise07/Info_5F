<?php
session_start();
require_once 'DatabaseConn.php';
$dbconfig = require 'configuration/DBconfiguration.php';
require_once 'function/funzioni_db.php';

$db = DatabaseConn::getDB($dbconfig);
if (is_null($db)) exit("Errore database");

$msg_error = '';

if (isset($_POST['btn_login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = autenticaPersonale($db, $email, $password);

    if ($user) {
        $_SESSION['user_id'] = $user->id_personale;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['primo_accesso'] = $user->primo_accesso;
        $_SESSION['tema_background'] = $user->tema_background;

        if ($user->primo_accesso) {
            header('Location: modifica_password.php');
        } else {
            header('Location: dashboard.php');
        }
        exit();
    } else {
        $msg_error = "<b class='msg-err'>Email o password errati!</b><br>";
    }
}

require_once 'header.php';
?>

    <h1>🔐 Login Personale FastRoute</h1>

<?php echo $msg_error; ?>

    <form action="login.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit" name="btn_login">Accedi</button>
    </form>

<?php
require_once 'footer.php';
?>