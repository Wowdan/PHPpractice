<?php
function __autoload($className){
    $filename = __DIR__ . "/Classes/" . $className . ".php";
    if (is_readable($filename)){
        require $filename;
    }
}

//向 spl_autoload 註冊此方法名稱
spl_autoload_register ('__autoload');
?>