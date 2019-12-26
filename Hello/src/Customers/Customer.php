<?php
namespace Customers;

class Customer{
  protected $cname;
  public function setName($cname){
    $this->cname = $cname;
    return "completed...";
  }
  
  public function getName(){
    return $this->cname;
  }
}
?>