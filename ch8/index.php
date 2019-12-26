<?php
//這是 index.php
include_once __DIR__ . "/autoload.php";

$member = new Member();
$member->getMemberList();

?>