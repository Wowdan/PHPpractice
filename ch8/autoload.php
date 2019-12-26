<?php
function __autoload($className){
    $filename = __DIR__ . "/Classes/" . $className . ".php";
    if (is_readable($filename)){
        require $filename;
    }
}
?>