create database if not exists ripasso_in_itinere;
use ripasso_in_itinere;

create table produttori (
id_produttore int primary key auto_increment,
nome varchar(50) not null,
nazione varchar(50)
);

create table standard_wifi (
id_standard int primary key auto_increment,
nome_standard varchar(30) not null,
banda varchar(50),
velocita_mb int
);

create table access_point (
id_ap int primary key auto_increment,
modello varchar(50) not null,
prezzo decimal(6,2),
id_produttore int,
id_standard int,
foreign key (id_produttore) references produttori(id_produttore),
foreign key (id_standard) references standard_wifi(id_standard)
);

insert into produttori (nome, nazione) values
('Chaina product', 'Cina'),
('Boh', 'Russia'),
('Produttore', 'Francia');

insert into standard_wifi (nome_standard, banda, velocita_mb) values
('802.11', '2.4 GHz', 11),
('802.11', '2.4 GHz', 54),
('802.11', '5 GHz', 300);

insert into access_point (modello, prezzo, id_produttore, id_standard) values
('asus', 20, 1, 2),
('msi', 50, 1, 3),
('asus', 90, 2, 3),
('TP-link', 45, 3, 1);

select * from produttori;
select * from standard_wifi;
select * from access_point;

delete table produttori;
delete table standrad_wifi;
delete table access_point;

select ap.modello, p.nome
from access_point ap
join produttori p on ap.id_produttore = p.id_produttore;

select ap.modello, s.nome_standard, s.banda, s.velocita_mb
from access_point ap
join standard_wifi s on ap.id_standard = s.id_standard;

select ap.modello, p.nome, s.nome_standard, s.velocita_mb
from access_point ap
join produttori p on ap.id_produttore = p.id_produttore
join standard_wifi s on ap.id_standard = s.id_standard;

select p.nome, count(ap.id_ap)
from produttori p
join access_point ap on p.id_produttore = ap.id_produttore
group by p.nome;

select s.nome_standard, avg(ap.prezzo)
from standard_wifi s
join access_point ap on s.id_standard = ap.id_standard
group by s.nome_standard
having avg(ap.prezzo) > 50;

select *
from produttori p
left join access_point ap on p.id_produttore = ap.id_produttore;

select *
from access_point ap
right join standard_wifi s on ap.id_standard = s.id_standard;
