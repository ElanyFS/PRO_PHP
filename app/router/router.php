<?php

//URI Fixa
//Verifica se a rota informada existe dentro da funcao routes
function existsRouter($uri, $routes)
{
    return array_key_exists($uri, $routes) ? 
    [$uri => $routes[$uri]] : 
    [];
}

//Uri dinamica 
function regularExpressionMatchArrayRoutes($uri, $routes)
{
    return array_filter(
        $routes,
        function ($value) use ($uri) {
            // var_dump($value);
            $regex = str_replace('/', '\/', ltrim($value, '/'));
            // var_dump($regex);
            return preg_match("/^$regex$/", ltrim($uri, '/'));
        },
        ARRAY_FILTER_USE_KEY
    );
}

//Pegar os parametros da uri da rota dinamica 
function params($uri, $matchedUri)
{
    if (!empty($matchedUri)) {
        $matchedToGetParams = array_keys($matchedUri)[0];
        return array_diff(
            $uri,
            explode('/', ltrim($matchedToGetParams, '/'))
        );
    }

    return [];
}

//Alterar nome dos parametros da uri
function paramsFormat($uri,$params)
{
    //Inica a varial com o array vazio
    $paramsData = [];

    //Percorre a variavel 'params' e atribui valores aos index
    foreach ($params as $index => $param) {
        $paramsData[$uri[$index - 1]] = $param;
    }

    return $paramsData;
}

function router()
{
    //Pegar uri exata
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // echo $uri;

    $routes = require 'routes.php';

    $requestMethod = $_SERVER['REQUEST_METHOD'];

    //Uri
    $matchedUri = existsRouter($uri, $routes[$requestMethod]);

    // echo $matchedUri;

    // $array1 = [
    //     'user','1','name','Elany'
    // ];

    // $array2 = [
    //     'user','[0-9]+','name','[a-zA-Z]+'
    // ];

    // var_dump(array_diff($array1,$array2));
    // die();
    $params = [] ; 

    if (empty($matchedUri)) {
        $matchedUri = regularExpressionMatchArrayRoutes($uri, $routes[$requestMethod]);
        $uri = explode('/', ltrim($uri, '/'));
        $params = params($uri, $matchedUri);

        $params = paramsFormat($uri,$params);

        // var_dump($params);
        // die();
        // var_dump($uri);
        // die();
        // var_dump($params);
    }

    if(!empty($matchedUri)){
        return controller($matchedUri, $params);
    }

    throw new Exception('Erro...');
}