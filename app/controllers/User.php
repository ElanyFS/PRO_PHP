<?php

namespace app\controllers;

class User
{
    public function userId($params)
    {
        // var_dump($params);
        // die();
        if (!isset($params['user'])) {
            return redirect('/');
        }

        $user = findBy('usuarios', '*', 'idusuario', $params['user']);

        var_dump($user);
        die();

        // return [
        //     'view' => 'userId.php',
        //     'data' => ['title' => $params['user'], 'user' => $user]
        // ];
    }

    public function createIndex()
    {
        return [
            'view' => 'create.php',
            'data' => ['title' => 'CreateUser']
        ];
    }

    public function createStore(){
        $validate = validate([
            'nome' => 'required',
            'email' => 'email|unique:usuarios',
            'password' => 'required|maxlen:8'
        ]);

        if(!$validate){
            return redirect('/user/create');
        }
    }
}
