<?php
include("../header.php");
include("../databaseConnection.php");
$dbconfig = include("../config.php");
$db = databaseConnection::getDB($dbconfig);

$case = $db->query("SELECT id_casa, nome FROM casa_automobilistica ORDER BY nome")->fetchAll();

$message = '';
if ($_POST){
    $stmt = $db->prepare("INSERT INTO pilota (nome, cognome, nazionalita, numero, id_casa) VALUES (:nome,:cognome,:nazionalita,:numero,:id_casa)");
    if($stmt->execute([
        ":nome"=>$_POST['nome'],
        ":cognome"=>$_POST['cognome'],
        ":nazionalita"=>$_POST['nazionalita'],
        ":numero"=>$_POST['numero'],
        ":id_casa"=>$_POST['id_casa']
    ])){
        $message = '<div class="success-message">Pilota inserito!</div>';
    }
}
?>

    <div class="content">
        <h2>Inserisci Pilota</h2>

        <?php echo $message; ?>

        <div class="form-container">
            <form method="POST">
                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="nome" required>
                </div>

                <div class="form-group">
                    <label>Cognome:</label>
                    <input type="text" name="cognome" required>
                </div>

                <div class="form-group">
                    <label>Nazionalità:</label>
                    <input type="text" name="nazionalita" required>
                </div>

                <div class="form-group">
                    <label>Numero:</label>
                    <input type="number" name="numero" min="1" required>
                </div>

                <div class="form-group">
                    <label>Casa:</label>
                    <select name="id_casa" required>
                        <option value="">Seleziona</option>
                        <?php foreach($case as $casa): ?>
                            <option value="<?php echo $casa->id_casa; ?>"><?php echo $casa->nome; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <input type="submit" value="Inserisci">
            </form>
        </div>
    </div>

<?php include("../footer.php"); ?>