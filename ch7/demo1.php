<?php
    include "Shepherd.php";
    $mydog = new Shepherd("Peter","brown","Shepherd",10);
    echo $mydog->name."<br />";
    echo $mydog->color."<br />";
    echo $mydog->style."<br />";
    echo $mydog->doWork."<br />";
    //子類別未改寫父類別的方法
    echo $mydog->doRun()."<br />";
?>
