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

// Gestione cambio tema
if (isset($_POST['btn_tema'])) {
    $tema = $_POST['tema'];
    aggiornaTema($db, $_SESSION['user_id'], $tema);
    $_SESSION['tema_background'] = $tema;
    // Ricarica la pagina per applicare il tema
    header('Location: dashboard.php');
    exit();
}

$user = getPersonaleById($db, $_SESSION['user_id']);
$plici = getTuttiPlici($db);

require_once 'header.php';
?>

    <h1>📊 Dashboard FastRoute</h1>

    <p>Benvenuto, <?php echo htmlspecialchars($_SESSION['user_email']); ?>!</p>

    <div class="theme-selector">
        <h3>🎨 Personalizza Tema</h3>
        <form action="dashboard.php" method="POST">
            <select name="tema">
                <option value="light" <?php echo ($_SESSION['tema_background'] == 'light') ? 'selected' : ''; ?>>Chiaro</option>
                <option value="dark" <?php echo ($_SESSION['tema_background'] == 'dark') ? 'selected' : ''; ?>>Scuro</option>
                <option value="blue" <?php echo ($_SESSION['tema_background'] == 'blue') ? 'selected' : ''; ?>>Blu</option>
            </select>
            <button type="submit" name="btn_tema">Salva Tema</button>
        </form>
    </div>

    <h2>Tutte le Spedizioni</h2>

    <table>
        <thead>
        <tr>
            <th>Codice</th>
            <th>Mittente</th>
            <th>Destinatario</th>
            <th>Sede Partenza</th>
            <th>Sede Arrivo</th>
            <th>Accettazione</th>
            <th>Spedizione</th>
            <th>Ritiro</th>
            <th>Stato</th>
        </tr>
        </thead>
        <tbody>
        <?php while($plico = $plici->fetch()):
            $stato = '';
            if ($plico->data_ora_ritiro) $stato = 'ritirato';
            elseif ($plico->data_ora_spedizione) $stato = 'in transito';
            else $stato = 'in partenza';

            $stato_class = '';
            if ($stato == 'in partenza') $stato_class = 'status-partenza';
            elseif ($stato == 'in transito') $stato_class = 'status-transito';
            else $stato_class = 'status-ritirato';
            ?>
            <tr>
                <td><?php echo htmlspecialchars($plico->codice_univoco); ?></td>
                <td><?php echo htmlspecialchars($plico->mittente_nome_completo); ?></td>
                <td><?php echo htmlspecialchars($plico->destinatario_nome_completo); ?></td>
                <td><?php echo htmlspecialchars($plico->sede_partenza_nome); ?></td>
                <td><?php echo htmlspecialchars($plico->sede_arrivo_nome); ?></td>
                <td><?php echo $plico->data_ora_accettazione; ?></td>
                <td><?php echo $plico->data_ora_spedizione ?? '-'; ?></td>
                <td><?php echo $plico->data_ora_ritiro ?? '-'; ?></td>
                <td><span class="status <?php echo $stato_class; ?>"><?php echo ucfirst($stato); ?></span></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

<?php
require_once 'footer.php';
?>