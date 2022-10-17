<?php

class Korisnici
{

    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select * from users where id=:id
        
        ');
        $izraz->execute([
            'id'=>$sifra
        ]);
        return $izraz->fetch(); 
    }

    // CRUD - R
    public static function read()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select * from users
        
        ');
        $izraz->execute(); // OVO MORA BITI OBAVEZNO
        return $izraz->fetchAll(); // vraća indeksni niz objekata tipa stdClass
    }

    // CRUD - C
    public static function create($p) //$p kao parametri - napisano skraćeno
    {
        $veza = DB::getInstance();
        $veza->beginTransaction();
        $izraz = $veza->prepare('
            insert into users (username,password,email,country,ime,prezime)
            values (:username,:password,:email,:country,:ime,:prezime);
        ');
        $izraz->execute([
            'username'=>$p['username'],
            'password'=>$p['password'],
            'email'=>$p['email'],
            'country'=>$p['country'],
            'ime'=>$p['ime'],
            'prezime'=>$p['prezime']
        ]);
        $sifraOsoba = $veza->lastInsertId();
        /*$izraz = $veza->prepare('
            insert into users (username,email)
            values (:username,:email);
        ');
        $izraz->execute([
            'username'=>$sifraOsoba,
            'email'=>$p['email']
        ]);*/
        /*$sifraKorisnik = $veza->lastInsertId();*/
        $veza->commit();
        return $sifraOsoba;
    }

    // CRUD - U
    public static function update($p)
    {
        $veza = DB::getInstance();
        $veza->beginTransaction();

        $izraz = $veza->prepare('
        
           select * from users where id=:id
        
        ');
        $izraz->execute([
            'id'=>$p['id']
        ]);
        $sifraOsoba = $izraz->fetchColumn();

        $izraz = $veza->prepare('
            update users set
            username=:username,
            password=:password,
            email=:email,
            country=:country,
            ime=:ime,
            prezime=:prezime
            where id=:id
        ');
        $izraz->execute([
            'username'=>$p['username'],
            'password'=>$p['password'],
            'email'=>$p['email'],
            'country'=>$p['country'],
            'ime'=>$p['ime'],
            'prezime'=>$p['prezime'],
            'id'=>$sifraOsoba
        ]);

       /* $izraz = $veza->prepare('
            update users set
            country=:country
            where id=:id
        ');
        $izraz->execute([
            'country'=>$p['country'],
            'id'=>$p['id']
        ]); */


        $veza->commit();

    }

     // CRUD - D
    public static function delete($id)
    {
        $veza = DB::getInstance();
        $veza->beginTransaction();

        $izraz = $veza->prepare('
        
           select * from users where id=:id
        
        ');
        $izraz->execute([
            'id'=>$id
        ]);
        $sifraOsoba = $izraz->fetchColumn();

        $izraz = $veza->prepare('
            delete from users where id=:id
        ');
        $izraz->execute([
            'id'=>$id
        ]);

        $izraz = $veza->prepare('
            delete from users where id=:id
        ');
        $izraz->execute([
            'id'=>$sifraOsoba
        ]);


        $veza->commit();
    }
}