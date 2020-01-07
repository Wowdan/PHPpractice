<?php
trait Hello {
    function sayHello() {
        return "Hello";
    }
    function sayWorld() {
        return "Trait World";
    }
    function sayHelloWorld() {
        echo $this->sayHello() . " " . $this->sayWorld();
    }
}

class Base {
    function sayWorld() {
        return "Base World";
    }
}
class HelloWorld extends Base {
    use Hello;
    functiom sayWorld() {
        return "World";
    }
}
$h = new HelloWorld();
$h->sayHelloWorld();
?>