#c:\xampp\mysql\bin\mysql -uphreeek -p --default_character_set=utf8 < "C:\Users\Phreeek\Desktop\ucenjephp.hr\bazaapp.sql"

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
    opis varchar(255) not null,
    putanja varchar(255) not null,
    boja int not null,
    kategorija int not null,
    users int not null,
    pletivo int not null,
    datumuploada datetime not null,
    tag int 
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

create table clan(
    id int not null primary key auto_increment,
    galerija int not null,
    tag int not null
);

create table tag(
    id int not null primary key auto_increment,
    naziv varchar(20)
);



alter table galerija add foreign key(users) references users(id);
alter table galerija add foreign key(kategorija) references kategorija(id);
alter table galerija add foreign key(pletivo) references pletivo(id);
alter table galerija add foreign key(boja) references boja(id);

alter table clan add foreign key(galerija) references galerija(id);
alter table clan add foreign key(tag) references tag(id);


insert into pletivo (naziv,debljina) values 
('CYCA 0','2ply'),('CYCA 1','3ply'),('CYCA 2','5ply'),('CYCA 3','8ply'),('CYCA 4','10ply'),('CYCA 6','>10ply');

insert into kategorija (naziv) values
('Disney'),('Gaming'),('Tradicionalno'),('Harry Potter'),('LoTR'),('Star Wars'),('Bratz'),('Pjeva??i'),('Pjeva??ice'),('??ivotinjsko carstvo'),('Anime'),('Halloween'),('Priroda');

insert into boja (naziv) values
('Zelena'),('Bijela'),('Crna'),('Plava'),('Crvena'),('Sme??a'),('??uta'),('Ljubi??asta'),('Roza'),('Be??'),('Siva'),('Naran??asta');

insert into users(username,password,email,country,ime,prezime) values
('writerironclad','$2a$12$L0..hkm.KKdjM1sN83IT2ucrgnagTJ65FEIDVo1KBVac.JVFBPGIi','mail1@mail.hr','','Hana','Tenk'),
('examplemortician','$2a$12$L0..hkm.KKdjM1sN83IT2ucrgnagTJ65FEIDVo1KBVac.JVFBPGIi','mail2@mail.hr','','Petra','Jeni??'),
('matterburied','$2a$12$L0..hkm.KKdjM1sN83IT2ucrgnagTJ65FEIDVo1KBVac.JVFBPGIi','mail3@mail.hr','','Danko','Ro??na'),
('parliamentbane','$2a$12$L0..hkm.KKdjM1sN83IT2ucrgnagTJ65FEIDVo1KBVac.JVFBPGIi','mail4@mail.hr','','Dinko','Rich'),
('choirclassic','$2a$12$L0..hkm.KKdjM1sN83IT2ucrgnagTJ65FEIDVo1KBVac.JVFBPGIi','mail5@mail.hr','','Hinko','Rich'),
('toothjeer','$2a$12$L0..hkm.KKdjM1sN83IT2ucrgnagTJ65FEIDVo1KBVac.JVFBPGIi','mail6@mail.hr','','Finko','Rich'),
('probablytada','$2a$12$L0..hkm.KKdjM1sN83IT2ucrgnagTJ65FEIDVo1KBVac.JVFBPGIi','mail7@mail.hr','','Tara','Naramak'),
('tobaccocluttered','$2a$12$L0..hkm.KKdjM1sN83IT2ucrgnagTJ65FEIDVo1KBVac.JVFBPGIi','mail8@mail.hr','','Lara','Or??o'),
('fleetworth','$2a$12$L0..hkm.KKdjM1sN83IT2ucrgnagTJ65FEIDVo1KBVac.JVFBPGIi','mail9@mail.hr','','Mara','Trebi??'),
('springelevator','$2a$12$L0..hkm.KKdjM1sN83IT2ucrgnagTJ65FEIDVo1KBVac.JVFBPGIi','mail10@mail.hr','','Larry','Black'),
('punchdock','$2a$12$L0..hkm.KKdjM1sN83IT2ucrgnagTJ65FEIDVo1KBVac.JVFBPGIi','mail11@mail.hr','','Barry','White'),
('unpacktraffic','$2a$12$L0..hkm.KKdjM1sN83IT2ucrgnagTJ65FEIDVo1KBVac.JVFBPGIi','mail12@mail.hr','','Marko','Lari??'),
('tickarray','$2a$12$L0..hkm.KKdjM1sN83IT2ucrgnagTJ65FEIDVo1KBVac.JVFBPGIi','mail13@mail.hr','','Darko','??ari??'),
('lemonbeg','$2a$12$L0..hkm.KKdjM1sN83IT2ucrgnagTJ65FEIDVo1KBVac.JVFBPGIi','mail14@mail.hr','','??arko','Mari??'),
('plumshoal','$2a$12$L0..hkm.KKdjM1sN83IT2ucrgnagTJ65FEIDVo1KBVac.JVFBPGIi','mail15@mail.hr','','Nata??a','Prpi??'),
('scourgetrashy','$2a$12$L0..hkm.KKdjM1sN83IT2ucrgnagTJ65FEIDVo1KBVac.JVFBPGIi','mail16@mail.hr','','Sa??a','Geter');

insert into galerija(naziv,opis,putanja,boja,kategorija,users,pletivo,datumuploada) values
('Mor??','Mor??evi u??ivaju na obali','galerija/slika1.jpg',11,10,1,6,now()),
('Kava','Jutarnja kavica se sipa','galerija/slika2.jpg',6,3,2,2,now()),
('Planina','Matterhorn se presijava u zoru','galerija/slika3.jpg',8,13,3,1,now()),
('Pas','Crni labrador moli za hranu','galerija/slika4.jpg',3,10,6,4,now()),
('Svjetionik','Slika svjetionika u magli','galerija/slika5.jpg',10,13,8,4,now()),
('Brijeg','Brijeg miruje u osami','galerija/slika6.jpg',12,13,10,3,now()),
('','','galerija/slika7.jpg',12,13,3,3,now()),
('','','galerija/slika8.jpg',12,13,3,3,now()),
('','','galerija/slika9.jpg',12,13,3,3,now()),
('','','galerija/slika10.jpg',12,13,3,3,now()),
('','','galerija/slika11.jpg',12,13,3,3,now()),
('','','galerija/slika12.jpg',12,13,3,3,now()),
('','','galerija/slika13.jpg',12,13,3,3,now()),
('','','galerija/slika14.jpg',12,13,3,3,now()),
('','','galerija/slika15.jpg',12,13,3,3,now()),
('','','galerija/slika16.jpg',12,13,3,3,now()),
('','','galerija/slika17.jpg',12,13,3,3,now()),
('','','galerija/slika18.jpg',12,13,3,3,now()),
('','','galerija/slika19.jpg',12,13,3,3,now()),
('','','galerija/slika20.jpg',12,13,3,3,now()),
('','','galerija/slika21.jpg',12,13,3,3,now()),
('','','galerija/slika22.jpg',12,13,3,3,now()),
('','','galerija/slika23.jpg',12,13,3,3,now());


