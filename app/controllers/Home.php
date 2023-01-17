<?php

namespace app\controllers;
class Home{
    public function index($params){
        $user = All('usuarios');
        return[
            'view' => 'home.php',
            'data' => ['title' => 'Home', 'users' => $user]
        ];
    }
}