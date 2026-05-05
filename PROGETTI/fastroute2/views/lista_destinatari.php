<?php
// File: views/lista_destinatari.php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../functions/funzioni.php';

if(!isset($_SESSION['id_personale'])) {
    header("Location: index.php?page=login");
    exit;
}

$destinatari = listaDestinatari($db);
?>
<div class="card">
    <h1>📋 Lista Destinatari</h1>

    <div style="overflow-x: auto;">
        <table>
            <thead>
            <tr><th>ID</th><th>Nome</th><th>Cognome</th><th>Indirizzo</th><th>Telefono</th><th>Email</th></tr>
            </thead>
            <tbody>
            <?php foreach($destinatari as $d): ?>
                <tr>
                    <td><?= $d->id_destinatario ?></td>
                    <td><?= htmlspecialchars($d->nome) ?></td>
                    <td><?= htmlspecialchars($d->cognome) ?></td>
                    <td><?= htmlspecialchars($d->indirizzo) ?></td>
                    <td><?= $d->telefono ?></td>
                    <td><?= $d->email ?? '-' ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>