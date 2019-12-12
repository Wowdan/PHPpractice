<?php
include "dog.php";
$mydog = new dog();
$mydog->age = 10;
echo "My Dog age is:" .$mydog->getAge();
?>