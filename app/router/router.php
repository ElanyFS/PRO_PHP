<?php

function routes()
{
    return require 'routes.php';
}

//Verifica se a rota informada existe dentro da funcao routes
function existsRouter($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        return [$uri => $routes[$uri]];
        // return $uri;
    }

    return [];
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

function router()
{
    //Pegar uri exata
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // echo $uri;

    $routes = routes();

    //Uri
    $matchedUri = existsRouter($uri, $routes);

    // echo $matchedUri;


    if (empty($matchedUri)) {
        $matchedUri = regularExpressionMatchArrayRoutes($uri, $routes);
    }

    var_dump($matchedUri);
    die();
}
