<?php
// Avvia la sessione SOLO se non è già attiva
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$tema_class = 'light';
if (isset($_SESSION['user_id']) && isset($_SESSION['tema_background'])) {
    $tema_class = $_SESSION['tema_background'];
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastRoute - Corriere Espresso</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="<?php echo $tema_class; ?>">
<div class="container">
    <div class="navbar">
        <a href="index.php">🏠 Home</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="dashboard.php">📊 Dashboard</a>
            <a href="inserisci_plico.php">📦 Nuovo Plico</a>
            <a href="spedisci_plico.php">🚚 Registra Spedizione</a>
            <a href="ritira_plico.php">✅ Registra Ritiro</a>
            <a href="verifica_stato.php">🔍 Verifica Stato</a>
            <a href="statistiche.php">📈 Statistiche</a>
            <a href="modifica_password.php">🔒 Modifica Password</a>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == 1): ?>
                <a href="gestione_personale.php">👥 Gestione Personale</a>
            <?php endif; ?>
            <a href="logout.php" class="logout-btn" style="background:#dc3545">🚪 Logout</a>
        <?php else: ?>
            <a href="login.php">🔐 Login Personale</a>
        <?php endif; ?>
    </div>