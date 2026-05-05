<?php
// File: views/profilo.php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../functions/funzioni.php';

if(!isset($_SESSION['id_personale'])) {
    header("Location: index.php?page=login");
    exit;
}

$msg_success = '';
$msg_error = '';

// Cambio password
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cambia_password'])) {
    $nuova_password = $_POST['nuova_password'] ?? '';

    if(validaPassword($nuova_password)) {
        if(cambiaPassword($db, $_SESSION['id_personale'], $nuova_password)) {
            $_SESSION['primo_accesso'] = 0;
            $msg_success = "Password cambiata con successo!";
        } else {
            $msg_error = "Errore nel cambio password.";
        }
    } else {
        $msg_error = "La password deve contenere almeno 8 caratteri, una maiuscola, una minuscola, un numero e un carattere speciale.";
    }
}

// Cambio tema
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cambia_tema'])) {
    $tema = $_POST['tema'] ?? 'light';
    if(cambiaTema($db, $_SESSION['id_personale'], $tema)) {
        $_SESSION['tema_background'] = $tema;
        $msg_success = "Tema cambiato con successo!";
    } else {
        $msg_error = "Errore nel cambio tema.";
    }
    header("Location: index.php?page=profilo");
    exit;
}
?>
<div class="card">
    <h1>⚙️ Il mio Profilo</h1>
    <p>Email: <strong><?= htmlspecialchars($_SESSION['email']) ?></strong></p>

    <?php if($_SESSION['primo_accesso'] == 1): ?>
        <div class="alert alert-error">⚠️ Questo è il tuo primo accesso. Devi cambiare la password per continuare.</div>
    <?php endif; ?>

    <?php if($msg_success): ?>
        <div class="alert alert-success"><?= $msg_success ?></div>
    <?php endif; ?>
    <?php if($msg_error): ?>
        <div class="alert alert-error"><?= $msg_error ?></div>
    <?php endif; ?>

    <form method="POST">
        <h2>🔒 Cambia Password</h2>
        <div class="form-group">
            <label>Nuova Password</label>
            <input type="password" name="nuova_password" required>
            <small>Minimo 8 caratteri, una maiuscola, una minuscola, un numero, un carattere speciale</small>
        </div>
        <button type="submit" name="cambia_password">Aggiorna Password</button>
    </form>

    <form method="POST" style="margin-top: 2rem;">
        <h2>🎨 Cambia Tema Grafico</h2>
        <div class="form-group">
            <label>Scegli tema</label>
            <select name="tema">
                <option value="light" <?= $_SESSION['tema_background'] == 'light' ? 'selected' : '' ?>>☀️ Chiaro</option>
                <option value="dark" <?= $_SESSION['tema_background'] == 'dark' ? 'selected' : '' ?>>🌙 Scuro</option>
                <option value="blue" <?= $_SESSION['tema_background'] == 'blue' ? 'selected' : '' ?>>💙 Blu</option>
            </select>
        </div>
        <button type="submit" name="cambia_tema">Applica Tema</button>
    </form>
</div>