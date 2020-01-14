<?php
//設定 cookie ，並設定有效時間
setcookie("name","Peter",time()+3600);
//存取 cookie
echo $_COOKIE["name"];
//消除 cookie
setcookie("name","Peter",time()-3600);
?>