<?php 

class Galerija

{

    public static function create($p)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
            insert into galerija (naziv,opis,boja,kategorija,pletivo) values
            (naziv=:naziv,opis=:opis,boja=:boja,kategorija=:kategorija,
            pletivo=:pletivo
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

    public static function readOne($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
           select * from galerija where id=:id
        
        ');
        $izraz->execute([
            'id'=>$id
        ]);
        $img = $izraz->fetch();

        return $img;
    }

    public static function update($p)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        update galerija set
            naziv=:naziv,
            opis=:opis,
            boja=:boja,
            kategorija=:kategorija,
            pletivo=:pletivo
        where sifra=:sifra;
        
        ');
        $izraz->execute($p);
    }

    public function ucitajJednu($id)
    {
        
    }

}