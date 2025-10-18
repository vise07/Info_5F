create table libri (
isbn varchar(13) primary key,
titolo varchar(50) not null,
autore varchar(50) not null,
argomento varchar(50),
editore varchar(50),
anno int,
edizione int
)