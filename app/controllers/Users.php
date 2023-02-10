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

        try{
            upload(640,480,'assets/img', 'crop');
        }catch(\Exception $e){
            setMessageError('upError', $e->getMessage(), '/edit');
        }
        // var_dump($_FILES);
        // die();

        // $file = $_FILES['file']['name'];

        // checkExtension(getExtension($file));

        

        // var_dump(getExtension($file));
    }
}
