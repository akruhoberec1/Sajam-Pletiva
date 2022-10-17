<?php 

class GalerijaController extends Controller
{
    private $phtmlDir = 'galerija' .
        DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render($this->phtmlDir . 'index',[
            'entiteti'=>Galerija::read()
        ]);
    }
}

