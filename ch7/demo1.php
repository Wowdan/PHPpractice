<?php
  include  "Shepherd.php";
  $mydog = new Shepherd("peter","棕色","牧羊犬",10);
  echo $mydog->name."<br />";
  echo $mydog->color."<br />";
  echo $mydog->style."<br />";
  echo $mydog->doWork()."<br />";
    //子類別未改寫父類別的方法
  echo $mydog->dogRun()."<br />";
?>
