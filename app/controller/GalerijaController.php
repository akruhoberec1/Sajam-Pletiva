<?php 

class GalerijaController extends Controller
{
    public $phtmlDir = 'galerija' .
        DIRECTORY_SEPARATOR;

    public $entitet;
    public $poruka;

    public function index()
    {
        $lista = Galerija::read();

        foreach($lista as $p){
            if(file_exists(BP. 'public' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR
        . 'galerija' . DIRECTORY_SEPARATOR . 'slika' . $p->id . '.jpg')){
            $p->slika= App::config('url') . 'public/img/galerija/' . 'slika' . $p->id . '.jpg';
        }else{
            $p->slika= 'ne mogu pronaći putanju';
        }
    }

        $this->view->render($this->phtmlDir . 'index',[
            'entiteti'=>$lista
        ]);
    }

    public function citajJednog($id)
    {
        $sess = (array)$_SESSION['autoriziranuser']; 
        $userid = $sess['id'];
        $lista = Profil::readGalleryByUserId($id);

        foreach($lista as $p){
            if(file_exists(BP. 'public' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR
        . 'galerija' . DIRECTORY_SEPARATOR . $userid . DIRECTORY_SEPARATOR . 'slika' . $p->id . '.jpg')){
            $p->slika= App::config('url') . 'public/img/galerija/' . $userid . DIRECTORY_SEPARATOR . 'slika' . $p->id . '.jpg';
        }else{
            $p->slika= 'ne mogu pronaći putanju';
        }
        }

            $this->view->render('private' . DIRECTORY_SEPARATOR . 'profil'
            . DIRECTORY_SEPARATOR . 'slikekorisnika',[
                'entiteti'=>$lista
            ]);
    }

    public function novaSlika()
    {

        $nova = Galerija::create([
            'naziv'=>'',
            'opis'=>'', 
            'boja'=>'',
            'kategorija'=>'',
            'pletivo'=>''
        ]);
        header('location: ' . App::config('url') 
                . 'galerija/promjena/' . $nova);
    }

    public function promjena($id)
    {
        $kategorije=$this->ucitajKategorije();
        $boje=$this->ucitajBoje();
        $pletiva=$this->ucitajPletiva();

        if(!isset($_POST['naziv'])){

            $e = Galerija::readOne($id);
            //Log::log($e);
            if($e==null){
                header('location: ' . App::config('url') . 'galerija');
            }
            
            $this->detalji($e,$kategorije,$boje,$pletiva,'Unesite podatke');
            return;
        }

        $this->entitet = (object) $_POST;
        $this->entitet->id=$id;

    

        if($this->kontrola()){
        if($this->entitet->kategorija==0){
            $this->entitet->kategorija=null;
        }
        Galerija::update((array)$this->entitet);
        header('location: ' . App::config('url') . 'detalji');
        return;
        }

        $this->detalji($this->entitet,$kategorije,$boje,$pletiva,$this->poruka);

    }
    
    public function detalji($e,$kategorije,$boje,$pletiva,$poruka)
    {

        $this->view->render($this->phtmlDir . 'detalji',[
            'e'=>$e,
            'kategorije'=>$kategorije,
            'boje'=>$boje,
            'pletiva'=>$pletiva,
            'poruka'=>$poruka,
            'css'=>'<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">',
            'js'=>'<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
            <script>
                let url=\'' .  App::config('url') .  '\';
                let galerija=' . $e->sifra . ';
            </script>
            <script src="'. App::config('url') . 'public/js/detaljiGalerije.js"></script>
            '
        ]);

    }

    private function ucitajBoje()
    {
        $boje = [];
        $b = new stdClass();
        $b->sifra=0;
        $b->naziv='Odaberi boju';
        $boje[]=$b;
        foreach(Boja::read() as $boja){
            $boje[]=$boja;
        }
        return $boje;

    }

    private function ucitajPletiva()
    {
        $pletiva = [];
        $p = new stdClass();
        $p->sifra=0;
        $p->naziv='Odaberi vrstu pletiva';
        $pletiva[]=$p;
        foreach(Pletivo::read() as $pletivo){
            $pletiva[]=$pletivo;
        }
        return $pletiva;

    }

    private function ucitajKategorije()
    {
        $kategorije = [];
        $k = new stdClass();
        $k->sifra=0;
        $k->naziv='Odaberi boju';
        $kategorije[]=$k;
        foreach(Kategorija::read() as $kategorija){
            $kategorije[]=$kategorija;
        }
        return $kategorije;

    }

    private function kontrola()
    {
        return $this->kontrolaKategorija();
    }

    private function kontrolaKategorija(){
        if($this->entitet->kategorija==0){
            $this->poruka='Obavezno odabrati kategoriju';
            return false;
        }
        return true;
    }

    public function slikaUpload()
    {
        if(!isset($_POST)){
            $this->poruka='Niste poslali datoteku';
        }else{

        }
    }

    public function admin()
    {
        $lista = Galerija::read();

        foreach($lista as $p){
            if(file_exists(BP. 'public' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR
        . 'galerija' . DIRECTORY_SEPARATOR . 'slika' . $p->id . '.jpg')){
            $p->slika= App::config('url') . 'public/img/galerija/' . 'slika' . $p->id . '.jpg';
        }else{
            $p->slika= 'ne mogu pronaći putanju';
        }
    }

        $this->view->render($this->phtmlDir . DIRECTORY_SEPARATOR . 'uredivanje',[
            'entiteti'=>$lista
        ]);
    }




}

