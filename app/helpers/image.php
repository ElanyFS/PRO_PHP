<?php

function getExtension($name)
{
    return pathinfo($name, PATHINFO_EXTENSION);
}

function isFileToUpload($fileName)
{
    if (!isset($_FILES[$fileName],$_FILES[$fileName]['name']) || $_FILES[$fileName]['name'] === '') {
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
    // getExtension($name);
    if (!in_array($name, ['jpg', 'png', 'pjeg'])) {
        throw new Exception("Tipo de arquivo inválido.");
    }
}

function resize($width, $height, $newWidth, $newHeight)
{
    $ratio = $width/$height;

    if($newWidth/$newHeight > $ratio){
        $newWidth = $newHeight*$ratio;
    }else{
        $newHeight = $newWidth/$ratio;
    }

    return [$newWidth, $newHeight];
}

function crop($width, $height, $newWidth, $newHeight)
{
    $thumbWidth = $newWidth;
    $thumbHeight = $newHeight;

    $srcAspect = $width / $height;
    $dstAspect = $thumbWidth / $thumbHeight;

    if($srcAspect > $dstAspect){
        $newWidth = $width / ($height / $thumbHeight);
    }else{
        $newHeight = $height / ($width / $thumbWidth);
    }

    return [$newWidth, $newHeight, $thumbWidth, $thumbHeight];
}

function upload($newWidth, $newHeight, $folder, $type = 'resize')
{

    isFileToUpload('file');

    $extension = getExtension($_FILES['file']['name']);

    checkExtension($extension);

    [$width, $height] = getimagesize($_FILES['file']['tmp_name']);

    [$functionCreateFrom, $saveImage] = getFunctionCreateFrom($extension);

    $src = $functionCreateFrom($_FILES['file']['tmp_name']);

    if($type === 'resize'){
        [$newWidth, $newHeight] = resize($width, $height, $newWidth, $newHeight);
        $dst = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    }else{
        [$newWidth, $newHeight, $thumbWidth ,$thumbHeight] = crop($width, $height, $newWidth, $newHeight);
        $dst = imagecreatetruecolor($thumbWidth, $thumbHeight);
        imagecopyresampled(
            $dst, 
            $src, 
            0 - ($newWidth - $thumbWidth) / 2, 
            0 - ($newHeight - $thumbHeight) / 2, 
            0, 
            0, 
            $newWidth, 
            $newHeight, 
            $width, 
            $height
        );
    }

    
    $saveImage($dst, $folder.DIRECTORY_SEPARATOR.rand().'.'.$extension);
}
