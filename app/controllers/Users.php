<?php

namespace app\controllers;

class Users
{
    // public function index()
    // {
    //     // echo json_encode($_SERVER);
    //     $users = all('usuarios', 'idusuario,nome_user');

    //     echo json_encode($users);
    // }

    public function store(){
        // var_dump($_FILES);
        // die();
        $file = $_FILES['file']['name'];

        isFileToUpload('file');

        checkExtension(getExtension($file));

        upload();

        // var_dump(getExtension($file));
    }
}
