<?php
require_once '../vendor/autoload.php';

use \Cars\Car;
$mycar = new Car();
$mycar->setName("Ford...");
echo $mycar->getName();
?>