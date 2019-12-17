<?php
    //引入dog類別
    include "dog.php";
    //定義Shepherd 是 dog 的子類別
    class Shepherd extends dog{
        //定義子類別需要的屬性
        protected $age;
{
        public function __construct($name,$color,$style,$age){
            //繼承父類別屬性
            parent::__construct($name,$color,$style);
            $this->age = $age;
        }
        //定義子類別的方法
        public function doWork(){
            echo "趕羚羊..."."<br />";
        }
        //覆寫(override)解構子
        public function __destruct(){
            echo "趕羚羊回家了";
        }
    }

?>