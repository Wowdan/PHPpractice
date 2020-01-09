<?php
interface Logger {
    public function log(string $msg);
}
class Application {
    private $logger;
    public function getlogger() : Logger {
        return $this->logger;
    }
    public function setLogger(Logger $logger) {
        $this->logger = $logger;
    }
}
$app = new Application;
//使用new class 建立匿名類別
$app->setLogger(new class implements Logger {
    public function log(string $msg) {
        print($msg);
    }
});

$app->getLogger()->log("這是一個匿名類別的例子");
?>