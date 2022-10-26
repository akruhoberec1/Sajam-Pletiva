<?php

class LoginuserController extends Controller
{
    public function prijava()
    {
       $this->prijavauserView('','Popunite tražene podatke');
    }

    public function autorizacija()
    {
       
        if(!isset($_POST['email']) || 
        !isset($_POST['password'])){
            $this->prijava();
            return;
        }


        if(strlen(trim($_POST['email']))===0){
            $this->prijavauserView('','Email obavezno');
            return;
        }


        if(strlen(trim($_POST['password']))===0){
            $this->prijavauserView($_POST['email'],'Lozinka obavezno');
            return;
        }

        
        $user = Loginkorisnik::autoriziraj($_POST['email'],$_POST['password']);
        if($user==null){
            $this->prijavauserView($_POST['email'],'Email i/ili Lozinka neispravni');
            return;
        }


       
            $_SESSION['autoriziranuser']=$user;
            header('location:' . App::config('url') . 'profil');

    }



    public function prijavauserView($email,$poruka)
    {
        $this->view->render('prijavauser',[
            'poruka'=>$poruka,
            'email'=>$email
        ]);
    }

    public function odjava()
    {
        unset($_SESSION['autoriziranuser']);
        session_destroy();
        $this->prijavauserView('','Uspješno ste odjavljeni');
               
    }



}