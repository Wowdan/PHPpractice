<?php
include "dog.php";

class Poodle extends dog{
    protected $size;

    public function __construct)($name,$color,$style,$size){
        parent::__construct($name,$color,$style);
        $this->size = $size;
    }
    //覆寫狗叫的function
    public function dogBark(){
        echo "狗叫...但小聲";
        //呼叫父親別的dogBark()
        parent::dogBark(;)
    }
}
?>