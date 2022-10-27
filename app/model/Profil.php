<?php

class Profil

{


    public static function read($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        select * from users where id=:sifra
        ');

        $izraz->execute();
        return $izraz->fetch();
    }

    public static function readGalleryByUserId($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select * from galerija a left join users b 
        on a.users=b.id where b.id=:id
        
        ');
        $izraz->execute(['id'=>$id]); // OVO MORA BITI OBAVEZNO
        return $izraz->fetchAll(); // vraća indeksni niz objekata tipa stdClass   
    }
}