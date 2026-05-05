<?php
// File: views/login.php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../functions/funzioni.php';

if(isset($_SESSION['id_personale'])) {
    header("Location: index.php?page=dashboard");
    exit;
}

$error = '';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $utente = verificaLogin($db, $email, $password);

    if($utente) {
        $_SESSION['id_personale'] = $utente->id_personale;
        $_SESSION['email'] = $utente->email;
        $_SESSION['tema_background'] = $utente->tema_background;
        $_SESSION['primo_accesso'] = $utente->primo_accesso;

        if($utente->primo_accesso == 1) {
            header("Location: index.php?page=profilo");
        } else {
            header("Location: index.php?page=dashboard");
        }
        exit;
    } else {
        $error = "Email o password errati.";
    }
}
?>
<div class="card">
    <h1>🔐 Accesso Personale FastRoute</h1>
    <?php if($error): ?>
        <div class="alert alert-error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Accedi</button>
    </form>
</div>