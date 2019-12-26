<?php
function __autoload($className){
    //從根目錄搜尋，尋找Classes資料夾，副檔名PHP的檔案
    $filename = __DIR__ . "/Classes/" . $className . ".php";
    //找可讀取的檔案
    if (is_readable($filename)){
        require $filename;
    }
}

//向 spl_autoload 註冊此方法名稱
spl_autoload_register ('__autoload');
?>