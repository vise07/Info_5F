DROP DATABASE IF EXISTS fastroute;
CREATE DATABASE fastroute;
USE fastroute;

CREATE TABLE mittente (
    id_mittente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    indirizzo VARCHAR(150) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    punti_fedelta INT DEFAULT 0
);

CREATE TABLE destinatario (
    id_destinatario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    indirizzo VARCHAR(150) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(100)
);

CREATE TABLE sede (
    id_sede INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    citta VARCHAR(50) NOT NULL,
    indirizzo VARCHAR(150) NOT NULL,
    telefono VARCHAR(20) NOT NULL
);

CREATE TABLE personale (
    id_personale INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    tema_background VARCHAR(20) DEFAULT 'light',
    primo_accesso TINYINT(1) DEFAULT 1
);

CREATE TABLE plico (
    id_plico INT AUTO_INCREMENT PRIMARY KEY,
    codice_univoco VARCHAR(20) NOT NULL UNIQUE,
    data_ora_accettazione DATETIME NOT NULL,
    data_ora_spedizione DATETIME,
    data_ora_ritiro DATETIME,
    id_mittente INT NOT NULL,
    id_destinatario INT NOT NULL,
    id_sede_partenza INT NOT NULL,
    id_sede_arrivo INT NOT NULL,
    id_personale_accett INT NOT NULL,
    id_personale_sped INT,
    id_personale_ritiro INT,
    FOREIGN KEY (id_mittente) REFERENCES mittente(id_mittente),
    FOREIGN KEY (id_destinatario) REFERENCES destinatario(id_destinatario),
    FOREIGN KEY (id_sede_partenza) REFERENCES sede(id_sede),
    FOREIGN KEY (id_sede_arrivo) REFERENCES sede(id_sede),
    FOREIGN KEY (id_personale_accett) REFERENCES personale(id_personale),
    FOREIGN KEY (id_personale_sped) REFERENCES personale(id_personale),
    FOREIGN KEY (id_personale_ritiro) REFERENCES personale(id_personale)
);

CREATE TABLE richiesta_info (
    id_richiesta INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    messaggio TEXT NOT NULL,
    data_richiesta DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO personale (email, password_hash, primo_accesso, tema_background) 
VALUES ('admin@fastroute.it', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'light');

INSERT INTO sede (nome, citta, indirizzo, telefono) VALUES
('Sede Centrale Milano', 'Milano', 'Via Roma 1, 20121 Milano', '02 1234567'),
('Sede Roma Tiburtina', 'Roma', 'Via Tiburtina 150, 00185 Roma', '06 7654321'),
('Sede Napoli Centrale', 'Napoli', 'Corso Umberto I 50, 80138 Napoli', '081 9876543'),
('Sede Torino', 'Torino', 'Corso Vittorio Emanuele II 100, 10121 Torino', '011 555666'),
('Sede Bologna', 'Bologna', 'Via Indipendenza 25, 40121 Bologna', '051 444333'),
('Sede Firenze', 'Firenze', 'Via dei Neri 10, 50122 Firenze', '055 777888'),
('Sede Palermo', 'Palermo', 'Via Roma 300, 90133 Palermo', '091 999000'),
('Sede Venezia', 'Venezia', 'Corso del Popolo 5, 30100 Venezia', '041 222333');
