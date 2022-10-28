<?php

$dev=$_SERVER['SERVER_ADDR']=='127.0.0.1';

if($dev){
    return [
        'dev'=>$dev,
        'url'=>'http://ucenjephp.hr/',
        'nazivApp'=>'Sajam Pletiva',
        'rps'=>8,
        'baza'=>[
            'server'=>'localhost',
            'baza'=>'bazaapp',
            'korisnik'=>'phreeek',
            'lozinka'=>'999'
        ]
    ];
}else{
    return [
    'dev'=>$dev,
    'url'=>'http://polaznik15.edunova.hr/',
    'nazivApp'=>'Sajam Pletiva',
    'rps'=>8,
    'baza'=>[
        'server'=>'localhost',
        'baza'=>'apolon_bazaapp',
        'korisnik'=>'apolon_admin',
        'lozinka'=>'Kruhoberec@456'
    ]
];
}