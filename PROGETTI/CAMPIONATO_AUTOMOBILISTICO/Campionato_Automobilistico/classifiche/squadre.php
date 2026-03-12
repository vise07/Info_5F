<?php
include("../header.php");
include("../databaseConnection.php");
$dbconfig = include("../config.php");
$db = databaseConnection::getDB($dbconfig);

$sql = "SELECT c.nome AS squadra, c.colore_livrea, 
        COUNT(DISTINCT p.id_pilota) AS numero_piloti,
        SUM(pa.punti) AS punti_totali
        FROM casa_automobilistica c
        LEFT JOIN pilota p ON c.id_casa = p.id_casa
        LEFT JOIN partecipare pa ON p.id_pilota = pa.id_pilota
        GROUP BY c.id_casa
        ORDER BY punti_totali DESC";
?>

    <div class="content">
        <h2>Classifica Squadre</h2>

        <div class="ranking-table">
            <table>
                <tr>
                    <th>Pos</th>
                    <th>Squadra</th>
                    <th>Colore</th>
                    <th>Piloti</th>
                    <th>Punti</th>
                </tr>
                <?php
                $pos = 1;
                foreach($db->query($sql) as $row):
                    ?>
                    <tr>
                        <td><?php echo $pos++; ?></td>
                        <td><?php echo $row->squadra; ?></td>
                        <td><?php echo $row->colore_livrea; ?></td>
                        <td><?php echo $row->numero_piloti; ?></td>
                        <td><strong><?php echo $row->punti_totali ?: 0; ?></strong></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

<?php include("../footer.php"); ?>