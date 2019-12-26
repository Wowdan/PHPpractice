<?php
function firstAutoload ($className){
    $filename = __DIR__ . "/first/" . $className . ".php";
    if (is_readable($filename)){
        require $filename;
    }
}
//向 spl_autoload 註冊此方法名稱
spl_autoload_register ('firstAutoload');
?>