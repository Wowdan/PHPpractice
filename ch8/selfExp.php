<?php
class EmailFormatException extends Exception {
    function printMessage() {
        echo "例外訊息: " . $this->getMessage() . "<br />";
    }
}
function checkEmail ($email) {
    if (!strpos($email,"@"))
        throw new EmailFormatException("E-mail需要包含'@'");
}
try {
    checkEmail('gmail.com');
}catch (EmailFormatException $e) {
    $e->printMessage();
}
?>