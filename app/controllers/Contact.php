<?php

namespace app\controllers;

use stdClass;

class Contact{
    public function index(){
        return [
            'view' => 'contact',
            'data' => ['title' => 'Contact']
        ];
    }

    public function store(){
        
        $email = new stdClass();

        // $email->fromName = 'Elany';
        // $email->fromEmail = 'ellanysouza09@gmail.com';
        // $email->toName = 'Carol';
        // $email->toEmail = 'bcarolyna@gmail.com';
        // $email->subject = 'teste de mensagem';
        // $email->message = 'Mensagem simples para teste.';

        $sent = send([
        'fromName' => 'Elany',
        'fromEmail' => 'ellanysouza09@gmail.com',
        'toName' => 'Carol',
        'toEmail' => 'bcarolyna@gmail.com',
        'subject' => 'teste de mensagem',
        'message' => 'Mensagem simples com array para teste .'
        ]);

        // $sent = send($email);

        var_dump($sent);
        die();
    }
}