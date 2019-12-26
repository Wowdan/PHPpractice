<?php
//這是 index.php
include_once __DIR__ . "/autoload.php";
include_once __DIR__ . "/firstAutoload.php";
include_once __DIR__ . "/secondAutoload.php";


$member = new Member();
$member->getMemberList();

$first = new First();
$first->doSomething();

$second = new Second();
$second->doSomething();
?>