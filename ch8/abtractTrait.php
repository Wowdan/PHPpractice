<?php
trait Message {
    private $message;

    function alert() {
        $this->define();
        echo $this->message;
    }
    abstract function define();
}

class Messenger {
    use Message;
    function define() {
        $this->message = "Custom Message";
    }
}

$messenger = new Messenger;
$messenger->alert();

?>