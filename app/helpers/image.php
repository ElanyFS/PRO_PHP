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
    if (!in_array($name, ['jpg', 'png', 'pjeg'])) {
        throw new Exception("Tipo de arquivo inválido.");
    }
}
