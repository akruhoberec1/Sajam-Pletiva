<?php 

class Galerija

{

    public static function create($p)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
            insert into galerija (naziv,opis,putanja,boja,kategorija,users,pletivo) values
            (naziv=:naziv,opis=:opis,putanja=:putanja,boja=:boja,kategorija=:kategorija,
            users=:users,pletivo=:pletivo
        ');

        $izraz->execute($p);
        return $veza->lastInsertId();

    }
        
    public static function read()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select * from galerija
        
        ');
        $izraz->execute(); // OVO MORA BITI OBAVEZNO
        return $izraz->fetchAll(); // vraća indeksni niz objekata tipa stdClass   
    }

    public static function readbyuserid($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
           select * from galerija where users=:id
        
        ');
        $izraz->execute(); // OVO MORA BITI OBAVEZNO
        return $izraz->fetchAll(); // vraća indeksni niz objekata tipa stdClass   
    }

}