<?php
require "../public/bootstrap.php";

// echo TESTE;
// echo "<br> Bem-vindo," . NOME;
try{
    router();
}catch(Exception $e){
    var_dump($e->getMessage());
}

?>