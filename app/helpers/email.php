<?php

use PHPMailer\PHPMailer\PHPMailer;

function config()
{

    $phpmailer = new PHPMailer();

    $phpmailer->isSMTP();
    $phpmailer->Host = $_ENV['EMAIL_HOST'];
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = $_ENV['EMAIL_PORT'];
    $phpmailer->Username = $_ENV['EMAIL_USERNAME'];
    $phpmailer->Password = $_ENV['EMAIL_PASSWORD'];

    return $phpmailer;
}


function send(stdClass|array $emailData)
{

    try {

        if(is_array($emailData)){
            $emailData = (object)$emailData;
        }

        // template($emailData);

        $body = (isset($emailData->template)) ? template($emailData) : $emailData->message;

        checkPropertiesEmail($emailData);

        $mail = config();

        //Recipients
        $mail->setFrom($emailData->fromEmail, $emailData->fromName);
        $mail->addAddress($emailData->toEmail, $emailData->toName);

        //Content
        $mail->isHTML(true);
        $mail->CharSet ='UTF-8';
        $mail->Subject = $emailData->subject;
        $mail->Body    = $body;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        return $mail->send();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        die();
    }
}

function checkPropertiesEmail($emailData)
{
    $propertiesRequired = ['toName', 'toEmail','fromName', 'fromEmail','subject', 'message'];
    unset($emailData->template);

    $emailVars = get_object_vars($emailData);

    foreach ($propertiesRequired as $prod) {
        if (!in_array($prod, array_keys($emailVars))) {
            throw new Exception("{$prod} é obrigátorio para enviar o email");
        }
    }
}

function template($emailData){

    $templateFile = ROOT. "/app/views/email/{$emailData->template}.html";

    if(!file_exists($templateFile)){
        throw new Exception("Template {$emailData->template} indisponivel.");
    }

    $template = file_get_contents($templateFile);

    $var = [];
    $emailVars = get_object_vars($emailData);

    foreach($emailVars as $key => $value){
        $var["@{$key}"] = $value;
    }

    $str = "Olá, @toName, seu email é @toEmail";

    // var_dump($var);

    return (str_replace(array_keys($var), array_values($var), $template));
}
