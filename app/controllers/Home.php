<?php

namespace app\controllers;
class Home{
    public function index($params){
        $user = All('usuarios');
        return[
            'view' => 'home',
            'data' => ['title' => 'Home', 'users' => $user]
        ];
    }
}