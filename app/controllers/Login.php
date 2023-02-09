<?php

namespace app\controllers;

class Login
{
    public function index()
    {
        // var_dump('Login');
        // die();

        return [
            'view' => 'login',
            'data' => ['title' => 'Login']
        ];
    }

    public function store($params)
    {

        // var_dump('Logado');
        // die();

        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

        if (empty($email) || empty($password)) {
            return setMessageError('message', 'Usuário ou senha inválidos.', '/login');
            // setFlash('message', 'Usuário ou senha inválidos.');
            // return redirect('/login');
        }

        $user = findBy('usuarios', '*', 'email', $email);
        // var_dump($user);
        // die();

        // if(!$user){
        //     var_dump($user);
        //     die();
        // }

        // var_dump($user->password);
        // die();

        if (!$user) {
            // var_dump($user);
            // die();
            return setMessageError('message', 'Usuário ou senha inválidos.', '/login');
            // setFlash('message', 'Usuário ou senha inválidos.');
            // return redirect('/login');
        }

        $senha = $user->password;

        if ($senha != $password) {
            // echo 'Senha incorreta';
            return setMessageError('message', 'Usuário ou senha inválidos.', '/login');
            // setFlash('message', 'Usuário ou senha inválidos.');
            // return redirect('/login');

        }

        // if(!password_verify($password, $user->password)){
        //     return redirect('/login');
        // }

        // echo 'Senha correta';

        $_SESSION[LOGGED] = $user;
        $_SESSION[LOG] = $user->idusuario;

        return redirect("/");
    }

    public function destroy()
    {
        unset($_SESSION[LOGGED]);
        return redirect('/');
    }
}
