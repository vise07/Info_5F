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
