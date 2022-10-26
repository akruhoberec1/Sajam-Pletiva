<?php

abstract class AutorizacijauserController extends Controller
{
    public function __construct()
    {
       parent::__construct();
       if(!isset($_SESSION['autoriziranuser'])){
            $this->view->render('prijava',[
                'email'=>'',
                'poruka'=>'Prvo se prijavite'
            ]);
       }
    }
}

