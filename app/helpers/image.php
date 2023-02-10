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

function getFunctionCreateFrom($extension)
{
    return match ($extension) {
        'png' => ['imagecreatefrompng', 'imagepng'],
        'jpg', 'jpeg' => ['imagecreatefromjpeg', 'imagejpeg']
    };
}

function checkExtension($name)
{
    getExtension($name);
    if (!in_array($name, ['jpg', 'png', 'pjeg'])) {
        throw new Exception("Tipo de arquivo inválido.");
    }
}

function resize($width, $height, $newWidth, $newHeight)
{
    $ratio = $width/$height;

    if($newWidth/$newHeight > $ratio){
        $newWidth = $newHeight*$ratio;
        $newHeight = $newHeight;
    }else{
        $newHeight = $newWidth/$ratio;
        $newWidth = $newWidth;
    }

    return [$newWidth, $newHeight];
}

function crop()
{
}

function upload($newWidth, $newHeight, $folder, $type = 'resize')
{

    $extension = getExtension($_FILES['file']['name']);

    [$width, $height] = getimagesize($_FILES['file']['tmp_name']);

    [$functionCreateFrom, $saveImage] = getFunctionCreateFrom($extension);

    $src = $functionCreateFrom($_FILES['file']['tmp_name']);

    if($type === 'resize'){
        [$newWidth, $newHeight] = resize($width, $height, $newWidth, $newHeight);
        $dst = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    }else{
        crop();
    }

    
    $saveImage($dst, $folder.DIRECTORY_SEPARATOR.rand().'.'.$extension);
}
