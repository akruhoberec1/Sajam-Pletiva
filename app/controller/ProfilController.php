<?php

class ProfilController extends AutorizacijauserController
{

    private $phtmlDir = 'private' . DIRECTORY_SEPARATOR .
        'profil' . DIRECTORY_SEPARATOR;

    private $entitet = null;
    private $poruka = '';


    public function index()
    {

        $this->view->render($this->phtmlDir . 'index');
    }

    public function uredi($id)
    {
        if(!isset($_POST['username'])){

            $e = Korisnici::readOne($id);
            if($e==null){
                header('location: ' . App::config('url') . 'index');
            }
            if(file_exists(BP. 'public' . DIRECTORY_SEPARATOR . 'img' . 
            DIRECTORY_SEPARATOR . 'korisnici' . DIRECTORY_SEPARATOR . $e->id . '.jpg')){
                $e->slika= App::config('url') . 'public/img/korisnici/' . $e->id . '.jpg';
            }else{
                $e->slika= App::config('url') . 'public/img/nepoznato.jpg'; 
            }
            $this->view->render($this->phtmlDir . 'detalji',[
                'e' => $e,
                'poruka' => 'Unesite podatke'
            ]);
            return;
        }

        $this->entitet = (object) $_POST;
        $this->entitet->id=$id;
    
        if($this->kontrola()){
            Korisnici::update((array)$this->entitet);
//određivanje gdje se miče slika tj. sprema
            if(isset($_FILES['slika'])){
                move_uploaded_file($_FILES['slika']['tmp_name'], 
                BP . 'public' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR
                 . 'korisnici' . DIRECTORY_SEPARATOR . $id . '.jpg');
            }

            header('location: ' . App::config('url') . 'profil');
            return;
        }
        

        $this->view->render($this->phtmlDir . 'detalji',[
            'e'=>$this->entitet,
            'poruka'=>$this->poruka
        ]);
    }

    private function kontrola()
    {
        return $this->kontrolaUsername() && $this->kontrolaPassword();
    }

    private function kontrolaUsername()
    {
        if(strlen($this->entitet->username)===0){
            $this->poruka = 'Username obavezno';
            return false;
        }
        return true;
    }

    private function kontrolaPassword()
    {
        if(strlen($this->entitet->password)===0){
            $this->poruka = 'Lozinka obavezna';
            return false;
        }
        $this->entitet->password = password_hash($this->entitet->password,PASSWORD_BCRYPT);
        
        return true;
    }
   

}
