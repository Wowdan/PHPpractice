<?php
require_once '../vendor/autoload.php';

use \Cars\Car;
use Customers\Customer;

$mycar = new Car();
$mycar->setName("Ford...");
echo "My Car: ".$mycar->getName();
echo "<br />";
$myprofile = new Customer();
$myprofile->setName("Peter");
echo "My Name: ".$myprofile->getName();

?>