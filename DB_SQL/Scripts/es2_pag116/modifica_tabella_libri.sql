alter table libri change column anno anno_pubblicazione int;

alter table libri add column cognome varchar(40);

alter table libri add column nome varchar(40);

alter table libri drop column autore;

alter table libri change column cognome autore_cognome varchar(50) not null;

alter table libri change column nome autore_nome varchar(50) not null;