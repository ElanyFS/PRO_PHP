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

        read('usuarios');
        where('idusuario','=',$params['user']);
        $user = execute();

        // var_dump($user);
        // die();

        return [
            'view' => 'userId',
            'data' => ['title' => $params['user'], 'user' => $user]
        ];
    }

    public function createIndex()
    {
        return [
            'view' => 'create',
            'data' => ['title' => 'CreateUser']
        ];
    }

    public function createStore()
    {
        $validate = validate([
            'nome_user' => 'required',
            'email' => 'email|required|unique:usuarios',
            'password' => 'maxlen:8|required'
        ], persistInput: true, checkCsrf: true);

        if (!$validate) {
            return redirect('/user/create');
        }

        $validate['password'] = password_hash($validate['password'], PASSWORD_DEFAULT);

        $create = create('usuarios', $validate);
        // $create = create('usuarios',['teste1', 'teste2']);

        if (!$create) {
            setFlash('message', 'Erro ao cadastrar usuário.');
            return false;
        }

        return redirect('/');

        var_dump($create);
    }
}
