<?php
// File: mail/invio_mail.php

function inviaMailConferma($email_destinatario, $codice_plico) {
    $oggetto = "Conferma ritiro plico - FastRoute";
    $messaggio = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #f4f4f4; }
            .header { background: #2c3e50; color: white; padding: 15px; text-align: center; }
            .content { background: white; padding: 20px; }
            .footer { text-align: center; font-size: 12px; color: #888; margin-top: 20px; }
            .codice { background: #1abc9c; color: white; padding: 5px 10px; border-radius: 5px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>FastRoute Corriere Espresso</h2>
            </div>
            <div class='content'>
                <h3>Conferma di Ritiro</h3>
                <p>Gentile Cliente,</p>
                <p>Il suo plico con codice <strong class='codice'>$codice_plico</strong> è stato ritirato con successo.</p>
                <p>Ha guadagnato <strong>1 punto</strong> nel programma fedeltà FastRoute!</p>
                <p>Grazie per aver scelto i nostri servizi.</p>
                <br>
                <p>Cordiali saluti,<br><strong>Team FastRoute</strong></p>
            </div>
            <div class='footer'>
                <p>Messaggio automatico, non rispondere a questa email.</p>
            </div>
        </div>
    </body>
    </html>
    ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: FastRoute <noreply@fastroute.it>" . "\r\n";

    // Per sviluppo su XAMPP senza SMTP, logghiamo l'invio
    error_log("EMAIL INVIATA A: $email_destinatario - Plico: $codice_plico");

    // Su server vero decommentare:
    // return mail($email_destinatario, $oggetto, $messaggio, $headers);

    return true; // Simula successo per sviluppo
}
?>