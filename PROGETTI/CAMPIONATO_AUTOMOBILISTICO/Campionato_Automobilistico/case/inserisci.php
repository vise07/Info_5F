<?php
include("../header.php");
include("../databaseConnection.php");
$dbconfig = include("../config.php");
$db = databaseConnection::getDB($dbconfig);

$message = '';
if ($_POST){
    $nome = $_POST['nome'];
    $colore = $_POST['colore'];

    $stmt = $db->prepare("INSERT INTO casa_automobilistica (nome, colore_livrea) VALUES (:nome, :colore)");
    if($stmt->execute([":nome"=>$nome, ":colore"=>$colore])){
        $message = '<div class="success-message">Casa automobilistica inserita!</div>';
    }
}
?>

    <div class="content">
        <h2>Inserisci Casa Automobilistica</h2>

        <?php echo $message; ?>

        <div class="form-container">
            <form method="POST">
                <div class="form-group">
                    <label>Nome Casa:</label>
                    <input type="text" name="nome" required>
                </div>

                <div class="form-group">
                    <label>Colore Livrea:</label>
                    <input type="text" name="colore" required>
                </div>

                <input type="submit" value="Inserisci">
            </form>
        </div>
    </div>

<?php include("../footer.php"); ?>