<?php
abstract class Animal {
    public function sleep(){
        echo '睡';
    }
}
class Dog extends Animal {
    public function move(){
        echo '跑';
    }
}
class Bird extends Animal{
    public function move(){
        echo '飛';
    }
}
class Action {
    public function actionMove(Animal $obj){
        $obj->move();
    }
}

$dog = new Dog();
$bird = new Bird();
$action = new Action();
$action->actionMove($dog);
$action->actionMove($bird);
?>