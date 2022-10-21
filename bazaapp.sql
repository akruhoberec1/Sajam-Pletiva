#C:\Users\Phreeek>c:\xampp\mysql\bin\mysql -uroot -p --default_character_set=utf8 < "C:\Users\Phreeek\Desktop\ucenjephp.hr\bazaapp.sql"

drop database if exists bazaapp;
create database bazaapp default character set utf8;
use bazaapp;

create table operater(
    sifra int not null primary key auto_increment,
    email varchar(50) not null,
    lozinka varchar(100) not null,
    username varchar(50) not null,
    uloga varchar(20) not null
);

insert into operater (email,lozinka,username,uloga) values 
('cro@chet.hr','$2a$08$wmuhT7SnpYhmbFkn12g7Lu1bSiXqm6G5SgUTzbQKqGAJV3a8PzTqu','admin','a'),
('oper@chet.hr','$2a$08$.wKrof5ZifOIJdFzdft9quV8b7cpZHbxxjIkcl5SmcMdLnb0XHssy','operater','o');

create table users(
id int not null primary key auto_increment,
username varchar(20),
password varchar(100),
email varchar(120),
country varchar(50),
ime varchar(20),
prezime varchar(20)
);

create table galerija(
    id int not null primary key auto_increment,
    naziv varchar(100) not null,
    putanja varchar(255) not null,
    boja varchar(50) not null,
    kategorija int not null
);

create table clan(
    id int not null primary key auto_increment,
    users int not null,
    galerija int not null
);

create table kategorija(
    id int not null primary key auto_increment,
    naziv varchar(100)
);

create table pletivo(
    id int not null primary key auto_increment,
    naziv varchar(50),
    debljina varchar(50)
);

create table boja(
    id int not null primary key auto_increment,
    naziv varchar(50)
);



alter table clan add foreign key(galerija) references galerija(id);
alter table clan add foreign key(users) references users(id);

alter table galerija add foreign key(kategorija) references kategorija(id);


insert into pletivo (naziv,debljina) values 
('CYCA 0','2ply'),('CYCA 1','3ply'),('CYCA 2','5ply'),('CYCA 3','8ply'),('CYCA 4','10ply'),('CYCA 6','>10ply');

insert into kategorija (naziv) values
('Disney'),('Gaming'),('Tradicionalno'),('Harry Potter'),('LoTR'),('Star Wars'),('Bratz'),('Pjevači'),('Pjevačice'),('Životinjsko carstvo'),('Anime'),('Halloween');

insert into boja (naziv) values
('Zelena'),('Bijela'),('Crna'),('Plava'),('Crvena'),('Smeđa'),('Žuta'),('Ljubičasta'),('Roza'),('Bež');

insert into users(username,password,email,country,ime,prezime) values
('writerironclad','$2a$08$I4YT5mH2Vl2IsaiNmWnoje49sCuofdfghuDYU7/IdNiLNjVhN3IYm','mail1@mail.hr','','Hana','Tenk'),
('examplemortician','$2a$08$I4YT5mH2Vl2IsaiNmWnoje49sCuofdfghuDYU7/IdNiLNjVhN3IYm','mail2@mail.hr','','Petra','Jenić'),
('matterburied','$2a$08$I4YT5mH2Vl2IsaiNmWnoje49sCuofdfghuDYU7/IdNiLNjVhN3IYm','mail3@mail.hr','','Danko','Rožna'),
('parliamentbane','$2a$08$I4YT5mH2Vl2IsaiNmWnoje49sCuofdfghuDYU7/IdNiLNjVhN3IYm','mail4@mail.hr','','Dinko','Rich'),
('choirclassic','$2a$08$I4YT5mH2Vl2IsaiNmWnoje49sCuofdfghuDYU7/IdNiLNjVhN3IYm','mail5@mail.hr','','Hinko','Rich'),
('toothjeer','$2a$08$I4YT5mH2Vl2IsaiNmWnoje49sCuofdfghuDYU7/IdNiLNjVhN3IYm','mail6@mail.hr','','Finko','Rich'),
('probablytada','$2a$08$I4YT5mH2Vl2IsaiNmWnoje49sCuofdfghuDYU7/IdNiLNjVhN3IYm','mail7@mail.hr','','Tara','Naramak'),
('tobaccocluttered','$2a$08$I4YT5mH2Vl2IsaiNmWnoje49sCuofdfghuDYU7/IdNiLNjVhN3IYm','mail8@mail.hr','','Lara','Oršo'),
('fleetworth','$2a$08$I4YT5mH2Vl2IsaiNmWnoje49sCuofdfghuDYU7/IdNiLNjVhN3IYm','mail9@mail.hr','','Mara','Trebić'),
('springelevator','$2a$08$I4YT5mH2Vl2IsaiNmWnoje49sCuofdfghuDYU7/IdNiLNjVhN3IYm','mail10@mail.hr','','Larry','Black'),
('punchdock','$2a$08$I4YT5mH2Vl2IsaiNmWnoje49sCuofdfghuDYU7/IdNiLNjVhN3IYm','mail11@mail.hr','','Barry','White'),
('unpacktraffic','$2a$08$I4YT5mH2Vl2IsaiNmWnoje49sCuofdfghuDYU7/IdNiLNjVhN3IYm','mail12@mail.hr','','Marko','Larić'),
('tickarray','$2a$08$I4YT5mH2Vl2IsaiNmWnoje49sCuofdfghuDYU7/IdNiLNjVhN3IYm','mail13@mail.hr','','Darko','Žarić'),
('lemonbeg','$2a$08$I4YT5mH2Vl2IsaiNmWnoje49sCuofdfghuDYU7/IdNiLNjVhN3IYm','mail14@mail.hr','','Žarko','Marić'),
('plumshoal','$2a$08$I4YT5mH2Vl2IsaiNmWnoje49sCuofdfghuDYU7/IdNiLNjVhN3IYm','mail15@mail.hr','','Nataša','Prpić'),
('scourgetrashy','$2a$08$I4YT5mH2Vl2IsaiNmWnoje49sCuofdfghuDYU7/IdNiLNjVhN3IYm','mail16@mail.hr','','Saša','Geter');