<?php
require_once 'DatabaseConn.php';
$dbconfig = require 'configuration/DBconfiguration.php';
require_once 'function/funzioni_db.php';

$db = DatabaseConn::getDB($dbconfig);
if (is_null($db)) exit("Errore database");

// Gestione richiesta informazioni
$msg_info = '';
if (isset($_POST['btn_richiesta'])) {
    try {
        inserisciRichiestaInfo($db, $_POST['nome'], $_POST['email'], $_POST['messaggio']);
        $msg_info = "<b class='msg-ok'>Grazie! La tua richiesta è stata inviata. Ti contatteremo presto.</b><br>";
    } catch (PDOException $e) {
        $msg_info = "<b class='msg-err'>Errore: " . $e->getMessage() . "</b><br>";
    }
}

require_once 'header.php';
?>

    <h1>🚚 FastRoute - Corriere Espresso</h1>

    <h2>Chi Siamo</h2>
    <p>FastRoute è l'agenzia di spedizioni leader nel settore, con sedi in tutta Italia.
        Offriamo servizi rapidi e affidabili per le tue spedizioni nazionali.</p>

    <h2>I Nostri Servizi</h2>
    <ul>
        <li>✈️ Spedizioni espresse in 24/48 ore</li>
        <li>📦 Tracciamento in tempo reale</li>
        <li>⭐ Programma fedeltà con punti accumulabili</li>
        <li>🏢 Oltre 50 sedi in tutta Italia</li>
        <li>💳 Assicurazione inclusa per ogni pacco</li>
    </ul>

    <h2>Come Funziona</h2>
    <ol>
        <li><strong>Consegna</strong> - Il mittente consegna il plico presso una sede FastRoute</li>
        <li><strong>Spedizione</strong> - Il corriere spedisce il plico verso la sede di destinazione</li>
        <li><strong>Ritiro</strong> - Il destinatario ritira il plico presso la sede di arrivo</li>
    </ol>

    <h2>Richiedi Informazioni</h2>
<?php echo $msg_info; ?>
    <form action="index.php" method="POST">
        <label>Nome e Cognome:</label>
        <input type="text" name="nome" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Messaggio:</label>
        <textarea name="messaggio" rows="5" required></textarea>

        <button type="submit" name="btn_richiesta">Invia Richiesta</button>
    </form>

<?php
require_once 'footer.php';
?>