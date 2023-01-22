<?php

namespace app\controllers;
class Home{
    public function index($params){

        // update('usuarios', ['nome_user' => 'Ana Carolyna Borges'], ['idusuarios' => '1']);
        // die();

        // delete("usuarios", ['idusuarios' => "3"]);
        // die();

        $user = All('usuarios');
        return[
            'view' => 'home',
            'data' => ['title' => 'Home', 'users' => $user]
        ];
    }
}