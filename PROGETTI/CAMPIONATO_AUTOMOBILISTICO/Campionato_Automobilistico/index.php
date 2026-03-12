<?php include 'header.php'; ?>

    <div class="content">
        <h2>🏁 Benvenuto al Campionato Automobilistico</h2>

        <div style="margin-bottom: 20px;">
            <h3>Statistiche</h3>
            <?php
            include 'databaseConnection.php';
            $dbconfig = include 'config.php';
            $db = databaseConnection::getDB($dbconfig);

            $piloti = $db->query("SELECT COUNT(*) as count FROM pilota")->fetch();
            $gare = $db->query("SELECT COUNT(*) as count FROM gara")->fetch();
            ?>
            <p>Piloti iscritti: <strong><?php echo $piloti->count; ?></strong></p>
            <p>Gare disputate: <strong><?php echo $gare->count; ?></strong></p>
        </div>

        <div>
            <p>Utilizza il menu in alto per gestire il campionato.</p>
        </div>
    </div>

<?php include 'footer.php'; ?>