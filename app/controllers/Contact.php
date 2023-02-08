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

    public function store()
    {

        $email = new stdClass();

        // $email->fromName = 'Elany';
        // $email->fromEmail = 'ellanysouza09@gmail.com';
        // $email->toName = 'Carol';
        // $email->toEmail = 'bcarolyna@gmail.com';
        // $email->subject = 'teste de mensagem';
        // $email->message = 'Mensagem simples para teste.';

        $validated = validate([
            'name' => 'required',
            'email' => 'required|unique',
            'subject' => 'required',
            'message' => 'required'
        ], persistInput:true, checkCsrf:true);

        if(!$validated){
            return redirect('/contact');
        }

        $sent = send([
        'fromName' => $validated['name'],
        'fromEmail' => $validated['email'],
        'toName' => $_ENV['TONAME'],
        'toEmail' => $_ENV['TOEMAIL'],
        'subject' => $validated['subject'],
        'message' => $validated['message'],
        'template' => 'contact'
        ]);

        // $sent = send([
        //     'fromName' => 'elany ferreira',
        //     'fromEmail' => 'ellanysouza08@gmail.com',
        //     'toName' => 'elany souza',
        //     'toEmail' => 'ellanysouza09@gmail.com',
        //     'subject' => 'teste',
        //     'message' => 'TESTE',
        //     'template' => 'contact'
        // ]);
        

        if ($sent) {
            return setMessageError('contact_success', 'Enviado com sucesso', '/contact');
        }

        return setMessageError('contact_error', 'Erro ao enviar e-mail', '/contact');

        // $sent = send($email);

        // var_dump($sent);
        // die();
    }
}