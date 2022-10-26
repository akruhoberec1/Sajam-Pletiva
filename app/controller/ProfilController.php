<?php

class ProfilController extends AutorizacijauserController
{
    public function index()
    {     

        $this->view->render('private' . DIRECTORY_SEPARATOR .
                            'profil' . DIRECTORY_SEPARATOR . 'index' );

        
    }
}