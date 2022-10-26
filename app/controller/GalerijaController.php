<?php 

class GalerijaController extends Controller
{
    public $phtmlDir = 'galerija' .
        DIRECTORY_SEPARATOR;

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
}

