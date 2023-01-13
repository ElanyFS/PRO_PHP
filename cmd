app/
    classes/
    controllers/
    database/
    helpers/
    router/
    views/
public/
    assets/
        style.css
        js
    index.php

composer install
composer init
composer dump-autoload -o


$controllerInstance = new $controllerNameSpace;

    // if(!method_exists($controllerInstance, $method)){
    //     throw new Exception( "O método {$method} não existe no controller {$controller}.");
    // }