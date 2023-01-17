<?php

function controller($matchedUri, $params){
    
    //o metodo explode remove o '@' e atribui os dois valores da variavel para o array
    [$controller, $method] = explode('@', array_values($matchedUri)[0]);
    $controllerWithNamespace = CONTROLLER_PATH . $controller;

    if (!class_exists($controllerWithNamespace)) {
        throw new Exception("Controller {$controller} não existe");
        // var_dump('exite');
        // die();
    }

    $controllerInstance = new $controllerWithNamespace;

    if(!method_exists($controllerWithNamespace, $method)){
        throw new Exception("O metódo {$method} não existe no controller {$controller}");
    }

    $controller = $controllerInstance->$method($params);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        die();
    }

    return $controller;

    // var_dump($controller);
    // die();
    // var_dump($matchedUri);
    // die();
}