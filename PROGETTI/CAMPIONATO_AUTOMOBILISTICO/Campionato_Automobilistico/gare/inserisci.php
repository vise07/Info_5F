<?php
include("../header.php");
include("../databaseConnection.php");
$dbconfig = include("../config.php");
$db = databaseConnection::getDB($dbconfig);

$message = '';
if ($_POST){
    $stmt = $db->prepare("INSERT INTO gara (nome, circuito, data) VALUES (:nome,:circuito,:data)");
    if($stmt->execute([
        ":nome"=>$_POST['nome'],
        ":circuito"=>$_POST['circuito'],
        ":data"=>$_POST['data']
    ])){
        $message = '<div class="success-message">Gara inserita!</div>';
    }
}
?>

    <div class="content">
        <h2>Inserisci Gara</h2>

        <?php echo $message; ?>

        <div class="form-container">
            <form method="POST">
                <div class="form-group">
                    <label>Nome Gara:</label>
                    <input type="text" name="nome" required>
                </div>

                <div class="form-group">
                    <label>Circuito:</label>
                    <input type="text" name="circuito" required>
                </div>

                <div class="form-group">
                    <label>Data:</label>
                    <input type="date" name="data" required>
                </div>

                <input type="submit" value="Inserisci">
            </form>
        </div>
    </div>

<?php include("../footer.php"); ?>