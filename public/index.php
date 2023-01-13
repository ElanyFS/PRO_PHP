<?php

require "../public/bootstrap.php";

// echo TESTE;
// echo "<br> Bem-vindo," . NOME;
try{
    router();
    
    require VIEWS.'master.php';
}catch(Exception $e){
    var_dump($e->getMessage());
}

?>