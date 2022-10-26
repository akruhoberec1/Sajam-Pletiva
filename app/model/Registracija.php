<?php 

class Registracija 
{

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
    }

    public static function readUsers()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select * from users
        
        ');
        $izraz->execute();
        return $izraz->fetch(); 
    }
}