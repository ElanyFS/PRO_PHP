<?php

namespace app\controllers;

class Home
{
    public function index($params)
    {

        $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);

        read('usuarios');

        // whereIn('nome_user', ['Allan Jeon', 'Malu']);

        // tableJoinReverse('municipios', 'id');


        if($search){
            search(['nome_user' => $search, 'email' => $search]);
        }

        // update('usuarios', ['nome_user' => 'Ana Carolyna Borges'], ['idusuarios' => '1']);
        // die();

        // delete("usuarios", ['idusuarios' => "3"]);
        // die();

        // $user = All('usuarios');

        // read('usuarios');

        // where('idusuario', '>', 0); 
        order('nome_user');

        // limit('5');
        pagination(5);

        // orAndWhere('nome_user', '=', 'Priscila', 'and');
        // execute();

        $users = execute();

        // var_dump($users);
        // die();

        return [
            'view' => 'home',
            'data' => ['title' => 'Home', 'users' => $users, 'links' => render()]
        ];
    }
}
