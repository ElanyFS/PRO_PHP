<?php

namespace app\controllers;

class User{
    public function userId($params){
        // var_dump($params);
        // die();
        if(!isset($params['user'])){
            redirect('/');
        }

        $user = findById('usuarios', 'idusuarios', $params['user']);
        // var_dump($user);

        return [
            'view' => 'userId.php',
            'data' => ['title' => $params['user'], 'user' => $user]
        ];
    }

    public function create(){
        return [
            'view' => 'create.php',
            'data' => ['title' => 'CreateUser']
        ];
    }

    /*Logar usuário */

    public function login(){
        return [
            
        ];
    }
}