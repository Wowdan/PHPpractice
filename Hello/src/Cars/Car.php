<?php
namespace Cars;

class Car{

  protected $name;

  public function setName($name){
    $this->name = $name;
    return "completed...";
  }

  public function getName(){
    return $this->name;
  }
}
?>