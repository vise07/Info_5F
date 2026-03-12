<?php
include("../header.php");
include("../databaseConnection.php");
$dbconfig = include("../config.php");
$db = databaseConnection::getDB($dbconfig);

$piloti = $db->query("SELECT p.id_pilota, p.nome, p.cognome, c.nome as casa FROM pilota p JOIN casa_automobilistica c ON p.id_casa = c.id_casa ORDER BY p.cognome")->fetchAll();
$gare = $db->query("SELECT id_gara, nome, data FROM gara ORDER BY data DESC")->fetchAll();

$message = '';
if ($_POST){
    try {
        $stmt = $db->prepare("INSERT INTO partecipare (id_pilota, id_gara, posizione, tempo, punti) VALUES (:id_pilota,:id_gara,:posizione,:tempo,:punti)");
        if($stmt->execute([
            ":id_pilota"=>$_POST['id_pilota'],
            ":id_gara"=>$_POST['id_gara'],
            ":posizione"=>$_POST['posizione'],
            ":tempo"=>$_POST['tempo'],
            ":punti"=>$_POST['punti']
        ])){
            $message = '<div class="success-message">Risultato inserito!</div>';
        }
    } catch (PDOException $e) {
        $message = '<div class="error-message">Errore: ' . $e->getMessage() . '</div>';
    }
}
?>

    <div class="content">
        <h2>Inserisci Risultato Gara</h2>

        <?php echo $message; ?>

        <div class="form-container">
            <form method="POST">
                <div class="form-group">
                    <label>Pilota:</label>
                    <select name="id_pilota" required>
                        <option value="">Seleziona</option>
                        <?php foreach($piloti as $pilota): ?>
                            <option value="<?php echo $pilota->id_pilota; ?>"><?php echo $pilota->nome . ' ' . $pilota->cognome . ' (' . $pilota->casa . ')'; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Gara:</label>
                    <select name="id_gara" required>
                        <option value="">Seleziona</option>
                        <?php foreach($gare as $gara): ?>
                            <option value="<?php echo $gara->id_gara; ?>"><?php echo $gara->nome . ' (' . date('d/m/Y', strtotime($gara->data)) . ')'; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Posizione:</label>
                    <input type="number" name="posizione" min="1" required>
                </div>

                <div class="form-group">
                    <label>Tempo:</label>
                    <input type="text" name="tempo" required placeholder="es. 1:32.456">
                </div>

                <div class="form-group">
                    <label>Punti:</label>
                    <input type="number" name="punti" min="0" value="0" required>
                </div>

                <input type="submit" value="Inserisci">
            </form>
        </div>
    </div>

<?php include("../footer.php"); ?>