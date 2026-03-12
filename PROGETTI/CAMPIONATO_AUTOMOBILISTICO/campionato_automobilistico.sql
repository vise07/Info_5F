create database if not exists campionato_automobilistico;

use campionato_automobilistico;


CREATE TABLE casa_automobilistica (
    id_casa INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    colore_livrea VARCHAR(20) NOT NULL
);


CREATE TABLE pilota (
    id_pilota INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    nazionalita VARCHAR(50) NOT NULL,
    numero INT NOT NULL,
    id_casa INT NOT NULL,
    
    FOREIGN KEY (id_casa) REFERENCES casa_automobilistica(id_casa)
);


CREATE TABLE gara (
    id_gara INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    circuito VARCHAR(50) NOT NULL,
    data DATE NOT NULL
);


CREATE TABLE partecipare (
    id_pilota INT,
    id_gara INT,
    posizione INT NOT NULL CHECK (posizione > 0),
    tempo VARCHAR(20) NOT NULL,
    punti INT DEFAULT 0 CHECK (punti >= 0),
    
    PRIMARY KEY (id_pilota, id_gara),
    
    FOREIGN KEY (id_pilota) REFERENCES pilota(id_pilota),
    FOREIGN KEY (id_gara) REFERENCES gara(id_gara)
);
