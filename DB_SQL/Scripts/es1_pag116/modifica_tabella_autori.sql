alter table autori change column cf codice_fiscale int not null unique;

alter table autori add column indirizzo varchar(40);

alter table autori add column cap varchar(5);

alter table autori change column cognome cognome varchar(50) not null;

alter table autori change column nome nome varchar(50) not null;