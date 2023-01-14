<?php

require "../public/bootstrap.php";

// echo TESTE;
// echo "<br> Bem-vindo," . NOME;
try{
    $data = router();

    extract($data['data']);

    if(!isset($data['view'])){
        throw new Exception('O índice view não está disponível.');
    }

    if(!file_exists(VIEWS.$data['view'])){
        throw new Exception("O índice view {$data['view']} não está disponível.");
    }

    $view = $data['view'];
    
    require VIEWS.'master.php';
}catch(Exception $e){
    var_dump($e->getMessage());
}

?>