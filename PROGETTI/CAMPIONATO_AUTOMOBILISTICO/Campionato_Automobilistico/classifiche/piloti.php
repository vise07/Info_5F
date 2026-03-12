<?php
include("../header.php");
include("../databaseConnection.php");
$dbconfig = include("../config.php");
$db = databaseConnection::getDB($dbconfig);

$sql = "SELECT p.nome, p.cognome, p.nazionalita, c.nome as squadra, SUM(pa.punti) AS totale_punti,
        COUNT(pa.id_gara) AS gare_disputate
        FROM pilota p
        JOIN casa_automobilistica c ON p.id_casa = c.id_casa
        LEFT JOIN partecipare pa ON p.id_pilota = pa.id_pilota
        GROUP BY p.id_pilota
        ORDER BY totale_punti DESC";
?>

    <div class="content">
        <h2>Classifica Piloti</h2>

        <div class="ranking-table">
            <table>
                <tr>
                    <th>Pos</th>
                    <th>Pilota</th>
                    <th>Nazionalità</th>
                    <th>Squadra</th>
                    <th>Gare</th>
                    <th>Punti</th>
                </tr>
                <?php
                $pos = 1;
                foreach($db->query($sql) as $row):
                    ?>
                    <tr>
                        <td><?php echo $pos++; ?></td>
                        <td><?php echo $row->nome . ' ' . $row->cognome; ?></td>
                        <td><?php echo $row->nazionalita; ?></td>
                        <td><?php echo $row->squadra; ?></td>
                        <td><?php echo $row->gare_disputate; ?></td>
                        <td><strong><?php echo $row->totale_punti ?: 0; ?></strong></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

<?php include("../footer.php"); ?>