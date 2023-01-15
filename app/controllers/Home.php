<?php

namespace app\controllers;
class Home{
    public function index($params){
        // var_dump($params);
        // die();
        $user = findAll('usuario');
        return[
            'view' => 'home.php',
            'data' => ['title' => 'Home', 'users' => $user]
        ];
    }
}