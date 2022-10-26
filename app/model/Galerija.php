<?php 

class Galerija

{
        
    public static function read()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select * from galerija
        
        ');
        $izraz->execute(); // OVO MORA BITI OBAVEZNO
        return $izraz->fetchAll(); // vraća indeksni niz objekata tipa stdClass   
    }

    public static function readbyid($id){

        $veza = DB::getInstance();
        $izraz = $veza->prepare('
            select * from galerija where users=:id
        ');

        $izraz->execute();
        return $izraz->fetchAll($id);
    }

}

