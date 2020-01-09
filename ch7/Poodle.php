<?php
include "dog.php";

class Poodle extends dog{
  protected $size;

  public function __construct($name,$color,$style,$size){
    parent::__construct($name,$color,$style);
    $this->size = $size;
  }
  // 實作父類別的狗叫
  public function Bark(){
    echo "狗叫...但小聲....";
    //呼叫父類別的 dogBark()
  }
}
?>