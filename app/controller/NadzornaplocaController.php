<?php

class NadzornaPlocaController extends AutorizacijaController
{
    public function index()
    {     

        $this->view->render('private' . DIRECTORY_SEPARATOR .
                            'nadzornaploca');

        
    }
}