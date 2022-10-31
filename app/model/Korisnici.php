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
    public static function read($stranica,$uvjet)
    {

        $rps = App::config('rps');
        $od = $stranica * $rps - $rps;

        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select id,ime,prezime,email,username,country from users
            where concat(ime,\'\',prezime,\'\',email,\'\',username)
            like :uvjet
            limit :od, :rps
        
        ');
        $uvjet= '%' . $uvjet . '%';

        $izraz->bindValue('od',$od,PDO::PARAM_INT);
        $izraz->bindValue('rps',$rps,PDO::PARAM_INT);
        $izraz->bindParam('uvjet',$uvjet);
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
        $izraz = $veza->prepare('
            insert into users (username,email)
            values (:username,:email);
        ');
        $izraz->execute([
            'username'=>$sifraOsoba,
            'email'=>$p['email']
        ]);
        $sifraKorisnik = $veza->lastInsertId();
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

    public static function search($uvjet)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
            select username,ime,prezime,email from users
            limit 10
        ');
        $izraz->execute([
            'uvjet' => '%' . $uvjet . '%'
        ]); 
        return $izraz->fetchAll(); 
    }

    public static function slikeBezKorisnika()
    {
        $veza= DB::getInstance();
        $izraz = $veza->prepare('
        
        select a.id, a.username, count(b.users) as kolicinaslika 
        from users a left join galerija b on a.id=b.users 
        group by a.id,a.username  
        
        ');

        $izraz->execute();
        return $izraz->fetchAll();

    }

    public static function ukupnoKorisnika($uvjet)
    {
        $veza= DB::getInstance();
        $izraz = $veza->prepare('
        
        select count(id) from users where concat(ime,\'\',
        prezime,\'\',email,\'\',username)
        like :uvjet
        
        ');
        $uvjet = '%' . $uvjet . '%';
        $izraz->bindParam('uvjet',$uvjet,PDO::PARAM_INT);
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function promjenaSifra($newpassword,$id)
    {
        $veza= DB::getInstance();
        $izraz = $veza->prepare('
        
        update users set password=:newpassword where id=:id
        
        ');

        $izraz->commit();  

    }

}
