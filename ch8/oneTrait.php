<?php
class Base {
    public function sayHello() {
        echo 'Hello';
    }
}
trait SayWorld {
    public function sayHello() {
        parent::sayHello();
        echo 'World';
    }
}
class MyHelloWorld extends Base {
    use sayWorld;
}

$o = new MyHelloWorld();
$o->sayHello();
?>