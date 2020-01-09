<?php
    class MyClass {
        public $x = 123;
        protected $y = "Spring";
        private $z = 'hello';

        public function getPara(){
            echo "inclass->x : ".$this->x."<br/>";
            echo "inclass->y : ".$this->y."<br/>";
            echo "inclass->z : ".$this->z."<br/>";
        }
    }


    $test = new MyClass();
    $test->getPara();
    echo "test->x : ".$test->x."<br/>";
    echo "test->y : ".$test->y."<br/>";
    echo "test->z : ".$test->z."<br/>";
?>