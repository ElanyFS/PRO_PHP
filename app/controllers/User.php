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
            'nome_user' => 'required',
            'email' => 'email|unique:usuarios',
            'password' => 'required|maxlen:8'
        ]);

        if(!$validate){
            return redirect('/user/create');
        }

        $validate['password'] = password_hash($validate['password'], PASSWORD_DEFAULT);

        $create = create('usuarios',$validate);

        if(!$create){
           setFlash('message', 'Erro ao cadastrar usuário.');
           return false; 
        }

        return redirect('/');

        var_dump($create);
    }
}
