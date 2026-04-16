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

// Solo l'admin (id_personale = 1) può gestire il personale
if ($_SESSION['user_id'] != 1) {
    header('Location: dashboard.php');
    exit();
}

$msg_success = '';
$msg_error = '';

// Inserimento nuovo operatore
if (isset($_POST['btn_inserisci'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (inserisciPersonale($db, $email, $password)) {
        $msg_success = "<b class='msg-ok'>Operatore inserito con successo! Email: $email</b><br>";
    } else {
        $msg_error = "<b class='msg-err'>Errore: Email già esistente o password non valida!<br>
                      La password deve avere: almeno 8 caratteri, una maiuscola, una minuscola, un numero e un carattere speciale.</b><br>";
    }
}

// Reset password
if (isset($_POST['btn_reset'])) {
    $id_personale = (int)$_POST['id_personale'];
    $nuova_password = $_POST['nuova_password'];

    if (resettaPasswordPersonale($db, $id_personale, $nuova_password)) {
        $msg_success = "<b class='msg-ok'>Password resettata con successo! Il nuovo operatore dovrà cambiarla al primo accesso.</b><br>";
    } else {
        $msg_error = "<b class='msg-err'>Errore: Password non valida!</b><br>";
    }
}

// Eliminazione operatore
if (isset($_POST['btn_elimina'])) {
    $id_personale = (int)$_POST['id_personale'];

    if ($id_personale == $_SESSION['user_id']) {
        $msg_error = "<b class='msg-err'>Non puoi eliminare te stesso!</b><br>";
    } elseif (eliminaPersonale($db, $id_personale)) {
        $msg_success = "<b class='msg-ok'>Operatore eliminato con successo!</b><br>";
    } else {
        $msg_error = "<b class='msg-err'>Errore: Non puoi eliminare l'ultimo amministratore!</b><br>";
    }
}

$personale = getAllPersonale($db);

require_once 'header.php';
?>

    <h1>👥 Gestione Personale (Area Amministratore)</h1>

<?php echo $msg_success; ?>
<?php echo $msg_error; ?>

    <!-- Form per inserire nuovo operatore -->
    <h2>➕ Inserisci Nuovo Operatore</h2>
    <form action="gestione_personale.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required placeholder="es. operatore@fastroute.it">

        <label>Password:</label>
        <input type="text" name="password" required placeholder="Admin123!">
        <small>Requisiti: almeno 8 caratteri, una maiuscola, una minuscola, un numero, un carattere speciale</small>

        <button type="submit" name="btn_inserisci">➕ Inserisci Operatore</button>
    </form>

    <hr>

    <!-- Lista operatori esistenti -->
    <h2>📋 Lista Operatori</h2>

    <table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
        <tr style="background-color: #333; color: white;">
            <th>ID</th>
            <th>Email</th>
            <th>Tema</th>
            <th>Primo Accesso</th>
            <th>Azioni</th>
        </tr>
        </thead>
        <tbody>
        <?php while($op = $personale->fetch()): ?>
            <tr>
                <td><?php echo $op->id_personale; ?></td>
                <td><?php echo htmlspecialchars($op->email); ?></td>
                <td><?php echo htmlspecialchars($op->tema_background); ?></td>
                <td><?php echo $op->primo_accesso_str; ?></td>
                <td>
                    <!-- Form per reset password -->
                    <form action="gestione_personale.php" method="POST" style="display: inline-block; margin: 5px;">
                        <input type="hidden" name="id_personale" value="<?php echo $op->id_personale; ?>">
                        <input type="text" name="nuova_password" placeholder="Nuova password" required style="width: 150px;">
                        <button type="submit" name="btn_reset" style="background-color: #ffc107; color: #333;">🔑 Reset Password</button>
                    </form>

                    <!-- Form per eliminare -->
                    <?php if($op->id_personale != 1): // Non eliminare l'admin principale ?>
                        <form action="gestione_personale.php" method="POST" style="display: inline-block; margin: 5px;"
                              onsubmit="return confirm('Sei sicuro di voler eliminare questo operatore?');">
                            <input type="hidden" name="id_personale" value="<?php echo $op->id_personale; ?>">
                            <button type="submit" name="btn_elimina" style="background-color: #dc3545;">🗑️ Elimina</button>
                        </form>
                    <?php else: ?>
                        <span style="color: gray;">⚠️ Admin principale</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <p><strong>Nota:</strong> Solo l'amministratore principale (ID 1) può accedere a questa pagina.</p>

<?php
require_once 'footer.php';
?>