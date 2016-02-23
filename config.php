<?php
// carregar as classes automaticamente

function __autoload($classe){
    include_once "classes/{$classe}.php";
}

?>
