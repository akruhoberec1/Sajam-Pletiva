<?php 

class RegistracijaController extends Controller
{
    public $phtmlDir = 'private' . 
    DIRECTORY_SEPARATOR . 'korisnici' .
    DIRECTORY_SEPARATOR;
    
    
    private $entitet=null;
    private $poruka='';



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
                . 'registracija/promjena/' . $noviKorisnik);
    }

        
    public function promjena($id)
    {
        if(!isset($_POST['username'])){

            $e = Korisnici::readOne($id);
            if($e==null){
                header('index');
            }

            $this->view->render('registracijadetalji',[
                'e' => $e,
                'poruka' => 'Unesite istinite podatke'
            ]);
            return;
        }

        $this->entitet = (object) $_POST;
        $this->entitet->id=$id;
    
        if($this->kontrola()){
            Korisnici::update((array)$this->entitet);
            header('location: ' . App::config('url') . 'korisnici');
            return;
        }

        $this->view->render('registracijadetalji',[
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
        return true;
    }











    /*public function registracija()
    {
       $this->registracijaView();
    }


    public function noviUser()
    {

    }

    private function registracijaView()
    {
        $this->view->render('registracija');
    }
*/



}