<?php

require "bootstrap.php";

try{
    $data = router();

    if(!isset($data['data'])){
        throw new Exception('O índice data não está disponível.');
    }

    if(!isset($data['data']['title'])){
        throw new Exception('O índice title não está disponível.');
    }

    if(!isset($data['view'])){
        throw new Exception('O índice view não está disponível.');
    }

    if(!file_exists(VIEWS.$data['view'])){
        throw new Exception("O índice view {$data['view']} não está disponível.");
    }

    extract($data['data']);

    $view = $data['view'];
    
    require VIEWS.'master.php';
}catch(Exception $e){
    var_dump($e->getMessage());
}

?>