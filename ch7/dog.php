<?php
class dog {
    //設定屬性
    public $name;
    public $color;
    public $style;
    
    //設定建構子
    public function __construct($name,$color,$style){
        $this->name = $name;
        $this->color = $color;
        $this->style = $style;
    }

    public function dogRun(){
        echo "狗狗跑步中...";
    }

    public function dogBark(){
        echo "狗叫...";
    }

    public function __destruct(){
        echo "狗狗回家了...";
    }
}
?>