<?php

function getExtension($name)
{
    return pathinfo($name, PATHINFO_EXTENSION);
}

function isFileToUpload($fileName)
{
    if (!isset($_FILES[$fileName]) || !isset($_FILES[$fileName]['name']) || $_FILES[$fileName]['name'] === '') {
        throw new Exception("O campo {$fileName} não existe ou não foi enviado arquivo.");
    }
}

function checkExtension($name)
{
    getExtension($name);
    if (!in_array($name, ['jpg', 'png', 'pjeg'])) {
        throw new Exception("Tipo de arquivo inválido.");
    }
}

function upload(){
    $dst = imagecreatetruecolor(640,480);

    [$width, $height] = getimagesize($_FILES['file']['tmp_name']);


    $src = imagecreatefrompng($_FILES['file']['tmp_name']);

    imagecopyresampled($dst,$src, 0,0,0,0,640,480, $width, $height);

    imagepng($dst, 'assets/img/teste.png');
}
