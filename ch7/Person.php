<?php
class Person {
    private $sex;
    public function __set($name, $value){
        
        //限制不可動態產生屬性
        if (isset($this->$name)) {
            return $this->$name = $value;
        } else {
            return null;
        }
    }
    //取得屬性名稱的值
    public function __get($name){
        return $name;
    }
    //判斷是否有該屬性參數
    public function __isset($name){
        return $name;
    }
    //取消該屬性
    public function __unset($name){
        return $name;
    }
}

$person = new Person();
//Person 類別沒有name 這個屬性名稱
//PHP_EOL 空格或是換行
$person->name = 'PHP';
echo $person->name.PHO_EOL;
echo isset($person->address);
unset($person->name);

?>