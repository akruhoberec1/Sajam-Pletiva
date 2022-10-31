<?php

class UploadController extends AutorizacijaController

{

    public function index()
    {

    }


    public function novi()
    {
        $novaSlika = Galerija::create([
            'naziv'=>'',
            'opis'=>'',
            'putanja'=>'',
            'boja'=>'',
            'kategorija'=>'',
            'users'=>'',
            'pletivo'=>''
        ]);
        header('location: ' . App::config('url') 
                . 'uploaduser/promjena/' . $novaSlika);
    }

        
    public function promjena($id)
    {
        if(!isset($_POST['username'])){

            $e = Galerija::ucitajJednu($id);
            if($e==null){
                header('index');
            }

            $this->view->render('uploaduserdetalji',[
                'e' => $e,
                'poruka' => 'Unesite istinite podatke'
            ]);
            return;
        }

        $this->entitet = (object) $_POST;
        $this->entitet->id=$id;
    
        if($this->kontrola()){
            Galerija::update((array)$this->entitet);
            header('location: ' . App::config('url') . 'profil');
            return;
        }

        $this->view->render('uploaduserdetalji',[
            'e'=>$this->entitet,
            'poruka'=>$this->poruka
        ]);
    }

    private function kontrola()
    {
        return $this->kontrolaNaziv() && $this->kontrolaKategorija();
    }

    private function kontrolaNaziv()
    {

        if(strlen($this->entitet->naziv)===0){
            $this->poruka = 'Naziv je obavezan';
            return false;
        }
        return true;
    }

    private function kontrolaKategorija()
    {
        if(strlen($this->entitet->kategorija)===0){
            $this->poruka = 'Kategorija je obavezna';
            return false;
        } 
        return true;
        }
    
    


}







