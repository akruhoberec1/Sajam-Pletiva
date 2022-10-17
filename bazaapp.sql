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
    boja varchar(50) not null,
    kategorija int not null,
    pletivo int not null,
    username int not null
);

create table kategorija(
    id int not null primary key auto_increment,
    naziv varchar(100)
);

create table pletivo(
    id int not null primary key auto_increment,
    naziv varchar(50),
    debljina decimal(18,2)
);

create table clankat(
    id int not null primary key auto_increment,
    galerija int not null,
    kategorija int not null
);

create table clanplet(
    id int not null primary key auto_increment,
    galerija int not null,
    pletivo int not null
);

create table clankorisnik(
    id int not null primary key auto_increment,
    galerija int not null,
    users int not null
);

alter table clankat add foreign key (galerija) references galerija(id);
alter table clankat add foreign key (kategorija) references kategorija(id);

alter table clanplet add foreign key (galerija) references galerija(id);
alter table clanplet add foreign key (pletivo) references pletivo(id);

alter table clankorisnik add foreign key(galerija) references galerija(id);
alter table clankorisnik add foreign key(users) references users(id);
