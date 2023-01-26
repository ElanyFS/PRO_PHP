<?php

namespace app\controllers;
class Home{
    public function index($params){

        // update('usuarios', ['nome_user' => 'Ana Carolyna Borges'], ['idusuarios' => '1']);
        // die();

        // delete("usuarios", ['idusuarios' => "3"]);
        // die();

        // $user = All('usuarios');

        read('usuarios');
        where('idusuario', '>', 0); 
        // order('idusuario');
        
        // limit('5');
        // pagination(10);
        
        orAndWhere('nome_user', '=', 'Priscila', 'and');
        execute();

        // $users = execute();

        
        // return[
        //     'view' => 'home',
        //     'data' => ['title' => 'Home', 'users' => $users]
        // ];
    }
}