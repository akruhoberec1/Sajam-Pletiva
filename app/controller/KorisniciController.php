<?php

class KorisniciController extends AutorizacijaController
{

    private $phtmlDir = 'private' . 
        DIRECTORY_SEPARATOR . 'korisnici' .
        DIRECTORY_SEPARATOR;

    private $entitet=null;
    private $poruka='';

    public function index()
    {
        $lista = Korisnici::read();
        foreach($lista as $p){
            if(file_exists(BP. 'public' . DIRECTORY_SEPARATOR . 'img' . 
            DIRECTORY_SEPARATOR . 'korisnici' . DIRECTORY_SEPARATOR . $p->id . '.jpg')){
                $p->slika= App::config('url') . 'public/img/korisnici/' . $p->id . '.jpg';
            }else{
                $p->slika= App::config('url') . 'public/img/nepoznato.jpg'; 
            }
        }
        $this->view->render($this->phtmlDir . 'index',[  
            'entiteti'=>$lista
        ]);
    }

    public function novi()
    {
        $noviKorisnik = Korisnici::create([
            'username'=>'',
            'password'=>'',
            'email'=>'',
            'country'=>'',
            'ime'=>'',
            'prezime'=>''
        ]);
        header('location: ' . App::config('url') 
                . 'korisnici/promjena/' . $noviKorisnik);
    }
    
    public function promjena($id)
    {
        if(!isset($_POST['username'])){

            $e = Korisnici::readOne($id);
            if($e==null){
                header('location: ' . App::config('url') . 'korisnici');
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

            header('location: ' . App::config('url') . 'korisnici');
            return;
        }
        

        $this->view->render($this->phtmlDir . 'detalji',[
            'e'=>$this->entitet,
            'poruka'=>$this->poruka
        ]);
    }

    private function kontrola()
    {
        return $this->kontrolaUsername() && $this->kontrolaPassword()
        && $this->kontrolaEmail();
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

    private function kontrolaEmail(){
        // domaća zadaća
        // ovdje implementirati https://regos.hr/app/uploads/2018/07/KONTROLA-OIB-a.pdf
        // dohvatiti si oib-e s http://oib.itcentrala.com/oib-generator/
        return true;
    }

    public function brisanje($id)
    {
        Korisnici::delete($id);
        header('location: ' . App::config('url') . 'korisnici');
    }

    public function testinsert()
    {
        for($i=0;$i<10;$i++){
            echo Korisnici::create([
                'ime'=>'Username ' . $i,
                'prezime'=>'Pass',
                'email'=>'',
                'country'=>'',
                'ime'=>'',
                'prezime'=>''
            ]);
        }
        
    }

    public function trazi()
    {
        if(!isset($_GET['term'])){
            return;
        }
        echo json_encode(Korisnici::search($_GET['term']));
    }
}