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

$msg_success = '';
$msg_error = '';

// Gestione inserimento mittente o selezione esistente
if (isset($_POST['btn_nuovo_mittente'])) {
    try {
        $id_mittente = inserisciMittente($db,
            $_POST['mittente_nome'],
            $_POST['mittente_cognome'],
            $_POST['mittente_indirizzo'],
            $_POST['mittente_telefono'],
            $_POST['mittente_email']
        );
        $msg_success = "<b class='msg-ok'>Mittente inserito con successo!</b><br>";
    } catch (PDOException $e) {
        $msg_error = "<b class='msg-err'>Errore inserimento mittente: " . $e->getMessage() . "</b><br>";
    }
}

// Gestione inserimento destinatario
if (isset($_POST['btn_nuovo_destinatario'])) {
    try {
        $id_destinatario = inserisciDestinatario($db,
            $_POST['dest_nome'],
            $_POST['dest_cognome'],
            $_POST['dest_indirizzo'],
            $_POST['dest_telefono'],
            $_POST['dest_email'] ?: null
        );
        $msg_success .= "<b class='msg-ok'>Destinatario inserito con successo!</b><br>";
    } catch (PDOException $e) {
        $msg_error .= "<b class='msg-err'>Errore inserimento destinatario: " . $e->getMessage() . "</b><br>";
    }
}

// Gestione accettazione plico
if (isset($_POST['btn_accetta'])) {
    $codice = generaCodiceUnivoco();
    try {
        $id_plico = inserisciAccettazione($db,
            $codice,
            (int)$_POST['id_mittente'],
            (int)$_POST['id_destinatario'],
            (int)$_POST['id_sede_partenza'],
            (int)$_POST['id_sede_arrivo'],
            $_SESSION['user_id']
        );
        $msg_success = "<b class='msg-ok'>Plico accettato! Codice: $codice</b><br>";
    } catch (PDOException $e) {
        $msg_error = "<b class='msg-err'>Errore accettazione: " . $e->getMessage() . "</b><br>";
    }
}

require_once 'header.php';
?>

    <h1>📦 Inserimento Nuovo Plico</h1>

<?php echo $msg_success; ?>
<?php echo $msg_error; ?>

    <!-- Sezione inserimento nuovo mittente -->
    <h2>1. Nuovo Mittente (se non presente)</h2>
    <form action="inserisci_plico.php" method="POST">
        <input type="text" name="mittente_nome" placeholder="Nome" required>
        <input type="text" name="mittente_cognome" placeholder="Cognome" required>
        <input type="text" name="mittente_indirizzo" placeholder="Indirizzo" required>
        <input type="text" name="mittente_telefono" placeholder="Telefono" required>
        <input type="email" name="mittente_email" placeholder="Email" required>
        <button type="submit" name="btn_nuovo_mittente">Salva Mittente</button>
    </form>

    <!-- Sezione inserimento nuovo destinatario -->
    <h2>2. Nuovo Destinatario (se non presente)</h2>
    <form action="inserisci_plico.php" method="POST">
        <input type="text" name="dest_nome" placeholder="Nome" required>
        <input type="text" name="dest_cognome" placeholder="Cognome" required>
        <input type="text" name="dest_indirizzo" placeholder="Indirizzo" required>
        <input type="text" name="dest_telefono" placeholder="Telefono" required>
        <input type="email" name="dest_email" placeholder="Email (opzionale)">
        <button type="submit" name="btn_nuovo_destinatario">Salva Destinatario</button>
    </form>

    <!-- Sezione accettazione plico -->
    <h2>3. Accetta Plico</h2>
    <form action="inserisci_plico.php" method="POST">
        <label>Scegli Mittente:</label>
        <select name="id_mittente" required>
            <option value="">-- Seleziona Mittente --</option>
            <?php
            $mittenti = getMittenti($db);
            while($m = $mittenti->fetch()):
                ?>
                <option value="<?php echo $m->id_mittente; ?>">
                    <?php echo htmlspecialchars($m->cognome . ' ' . $m->nome . ' - ' . $m->email); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Scegli Destinatario:</label>
        <select name="id_destinatario" required>
            <option value="">-- Seleziona Destinatario --</option>
            <?php
            $destinatari = getDestinatari($db);
            while($d = $destinatari->fetch()):
                ?>
                <option value="<?php echo $d->id_destinatario; ?>">
                    <?php echo htmlspecialchars($d->cognome . ' ' . $d->nome . ' - ' . ($d->email ?: 'N/A')); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Sede di Partenza:</label>
        <select name="id_sede_partenza" required>
            <?php
            $sedi = getSedi($db);
            while($s = $sedi->fetch()):
                ?>
                <option value="<?php echo $s->id_sede; ?>">
                    <?php echo htmlspecialchars($s->nome . ' - ' . $s->citta); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Sede di Arrivo:</label>
        <select name="id_sede_arrivo" required>
            <?php
            $sedi2 = getSedi($db);
            while($s = $sedi2->fetch()):
                ?>
                <option value="<?php echo $s->id_sede; ?>">
                    <?php echo htmlspecialchars($s->nome . ' - ' . $s->citta); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit" name="btn_accetta">Accetta Plico</button>
    </form>

<?php
require_once 'footer.php';
?>