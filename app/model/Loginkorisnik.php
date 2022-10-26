<?php

class Loginkorisnik
{
    public static function autorizirajuser($email,$password)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select * from users where email=:email;
        
        ');
        $izraz->execute([
            'email'=>$email
        ]);
        $users = $izraz->fetch();
        if($users==null){
            return null;
        }
        if(!password_verify($password,$users->password)){
            return null;
        }
        unset($users->password);
        return $users;
        return $users->id;
    }
}