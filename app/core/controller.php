<?php

function controller($matchedUri, $params){
    // var_dump($matchedUri);

    [$controller, $method] = explode('@', array_values($matchedUri)[0]);

    $controllerNameSpace = CONTROLLER_PATH.$controller;

    // var_dump($controller);
    // var_dump($method);

    if(!class_exists($controllerNameSpace)){
        // var_dump('Não existe');
        // die();
        throw new Exception("O controller {$controller} não existe.");
    }

    $controllerInstance = new $controllerNameSpace;

    if(!method_exists($controllerInstance, $method)){
        throw new Exception("O método {$method} não existe no controller {$controller}.");
    }

    return $controllerInstance->$method($params);
}