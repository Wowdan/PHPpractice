### 第七章 PHP 進階語法 I
#### 函數
+ 函數的作用 : 將功能相同的程式碼提出，以減少撰寫相同功能的程式碼
+ 使用方式
  + 語法 :
    ```php
      // 有數值需要傳遞時，需要設定參數
      // 若無傳遞數值的必要時，可不用設定參數
      function 函數名稱 (參數1,參數2,.....){
          需要執行的程式;

          //無需將執行結果傳出時，可以不用寫回傳值
          return 回傳值;
      }
    ```
  + 例 : ex7_1.php
    ```php
    <?php
      // 顯示名字
      function name(){
          echo "Peter";
      }

      // 計算成績等級
      function score($i) {
          $j = "F";
          $level = intval($i / 10);
          switch ($level){
              case 10:
              case 9:
                $j = "A";
                break;
              case 8:
                $j = "B";
                break;
              case 7:
                $j = "C";
                break;
              case 6:
                $j = "D";
                break;
              default:
                $j = "E";
          }
          return $j;
      }

      echo name();
      $backscore = score(85);
      echo "　成績等級：$backscore";
    ?>
    ```

+ 可變長度引數
  + 若傳遞進入函數的參數個數不確定，可以使用可變長度引數的參數設定
  + 使用方式
    + 語法 :
      ```php
        //重點在於那個「...」
        function 函數名稱 (...$參數名稱){
            需要執行的程式碼;
            return 回傳值;
        }
      ```
    + 例 : ex7_2.php
      ```php
      <?php
          function sum(...$numbers){
              $total = 0;
              foreach ($numbers as $i){
                  $total += $i;
              }
              return $total;
          }

          echo "總共是：".sum(1,3,5,7,9);
      ?>
      ```

+ 遞迴函數
  + 基本精神 : 函數自己呼叫自己！
  + 例 : ex7_3.php
    ```php
    <?php
      function table99($i=2,$j=1){
        if ($j > 9){
          $i++;
          $j = 1;
          echo "<br />";
        }
        if ( $i <= 9 ){
          printf("%d*%d=%d \t",$i,$j,($i*$j));
          $j++;
          table99($i,$j);
        }
      }
      echo table99();
    ?>
    ```

+ 參數與回傳值宣告
  + PHP 7 之後，函數的參數與回傳值，可宣告資料型態
  + 例 :
    ```php
    <?php
      function add(int $i,int $j):int{
        return ($i+$j);
      }
      echo add(3,5);
    ?>
    ```

#### 物件導向
+ 物件導向的目的 : 
  + 增加程式的重複利用性
  + 減少重複撰寫程式
  + 增加程式可擴充及延展性
  + 增加開發程式的靈活性

+ 類別與物件 (Class & Object)
  + 類別 : 定義物件的內容！其包含類別的函數與變數！
    + 函數 : 類別的方法
    + 變數 : 類別的屬性
    + 語法 :
      ```php
      class 類別名稱 {
        //　設定變數
        public 變數名稱;
        .....
        // 設定函數
        public function 函數名稱(參數1,參數2,....){
          // 可以執行程式的區塊
        }
      }
      ```
    + 例 : dog.php
      ```php
      <?php
        class dog {
          // 定義 dog 的年紀「屬性」
          public $age;
          // 定義取得 dog 年紀屬性值的「方法」
          public function getAge(){
            return $this->age;
          }
        }
      ?>
      ```
      + 「->」: 代表呼叫物件的屬性或方法名稱
      + this : 表示「這個物件」自己

  + 物件 : 實際使用的程式碼，由類別實例化而來
    + 語法 :
      ```php
        變數名稱 = new 類別名稱;
      ```
    + 例 : demo.php
      ```php
        <?php
          include "dog.php";
          $mydog = new dog();
          $mydog->age = 10;
          echo "我的狗年紀 : ".$mydog->getAge();
        ?>
      ```
  
+ 封裝 (Encapsulation)
  + 用於限制物件資源的使用
  + 存取權限分類 :
    + public : 可以在任何地方存取該物件資源！若沒指定，PHP 會指定其為預設值！
    + protected : 可以在自身類別和子類別中存取！
    + private : 只能在自身類別中存取！
    + 例 : MyClass.php
      ```php
        <?php
          class MyClass {
            public $x = 123;
            protected $y = "Spring";
            private $z = 'hello';

            public function getPara(){
              echo "inclass->x : ".$this->x."<br />";
              echo "inclass->y : ".$this->y."<br />";
              echo "inclass->z : ".$this->z."<br />";
            }
          }

          $test = new MyClass();
          $test->getPara();
          echo "test->x : ".$test->x."<br />";
          echo "test->y : ".$test->y."<br />";
          echo "test->z : ".$test->z."<br />";
        ?>
      ```

+ 建構子(constructor)與解建構子(destructor)
  + 建構子 : 用於建立物件時，一併設定好物件相關屬性與設定！
  + 解建構子 : 用於消除物件時，一併解除物件相關屬性與設定！通常放於類別最後面，程式會自動執行，不需要特別呼叫！
  + 例 : 修改先前的 dog.php 程式
    ```php
    <?php
    class dog {
       // 設定狗的屬性
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
    ```
    -----
    + demo.php  
    ```php
    <?php
        include "dog.php";
        $myDog = new dog("來福","白色","台狗土狗");
        $myDog->dogRun();
    ?>
    ```

+ 繼承(extends)
  + 作用
    + 避免寫出重複的程式碼！
    + 依據需求，重複利用相同程式碼，做出功能不同的程式！
    + 子類別繼承父類別的屬性與方法，免去定義相同功能！
    + 必要時，子類別除了可以定義自己的屬性與方法，也可改寫父類別的屬性與方法！
  + 語法 :
    ```php
    class 子類別名稱 extends 父類別名稱 {
      可執行的程式;
    }
    ```
  + 例 : 牧羊犬是狗的一個子類別 Shepherd.php
    ```php
    <?php
      // 引入 dog 類別
      include "dog.php";
      // 定義牧羊犬 Shepherd 是 狗 dog 的子類別
      class Shepherd extends dog{
         // 定義子類別需要的屬性
         protected $age;

         public function __construct($name,$color,$style,$age){
           // 繼承父類別的屬性
           parent::__construct($name,$color,$style);
           $this->name = $name;
           $this->color = $color;
           $this->style = $style;
           $this->age = $age;
          }
         // 定義子類別的方法 
         public function doWork(){
           echo "趕羊..."."<br />";
         }
         // 覆寫(override)解構子
         public function __destruct(){
           echo "趕羊到家了";
         }
       }
    ?>
    ```
--------------
  + demo1.php
    ```php
    <?php
      include  "Shepherd.php";
      $mydog = new Shepherd("peter","棕色","牧羊犬",10);
      echo $mydog->name."<br />";
      echo $mydog->color."<br />";
      echo $mydog->style."<br />";
      echo $mydog->doWork()."<br />";
      //子類別未改寫父類別的方法
      echo $mydog->dogRun()."<br />";
    ?>
    ```

+ 覆寫(override)
  + 作用
    + 子類別需要改寫父類別中，相同的方法名稱時！
    + 覆寫後，仍可以呼叫父類別中相同的方法！
    + 
  + 例 : Poodle.php
    ```php
    <?php
    include "dog.php";

    class Poodle extends dog{
      protected $size;

      public function __construct($name,$color,$style,$size){
        parent::__construct($name,$color,$style);
        $this->size = $size;
      }
      // 覆寫狗叫的 function
      public function dogBark(){
        echo "狗叫...但小聲....";
        //呼叫父類別的 dogBark()
        parent::dogBark();
      }
    }
    ?>
    ```
    -----
  + demo2.php
    ```php
    <?php
      include "Poodle.php";

      $mydog = new Poodle("Windy","白色","貴賓狗",30);
      echo $mydog->dogBark();
    ?>
    ```

+ 介面(interface)
  + 作用
    + 定義相同的功能名稱，但可以由執行的類別，各自實作功能！
    + 有實作介面的類別，一定要實作內容！
    + 介面可以繼承其他的介面！
    + 類別可以同時執行多個介面！
  + 例 : Bark.php
    ```php
    <?php
      interface Bark{
        public function bark();
      }
    ?>
    ```
    -------
  + Swim.php
    ```php
    <?php
      interface Swim{
        public function swim();
      }
    ?>
    ```
    -----
  + Human.php
    ```php
    <?php
      include "Bark.php";
      include "Swim.php";
      class Human implements Bark, Swim{
        public function bark(){
          echo "人類叫聲...是在叫什麼啦！！";
        }
        public function swim(){
          echo "人類在游泳...不是在洗澡嗎？";
        }
      }
    ?>
    ```
    ----
  + demo3.php
    ```php
    <?php
      include "Human.php";
      $man = new Human();
      echo $man->bark();
      echo $man->swim();
    ?>
    ```
  + 作業 : 
    + 修改 dog.php 檔案，使用 Bark.php 介面程式
    + 修改 cat.php 檔案，使用 Bark.php 介面程式

+ 抽象類別 (Abstract)
  + 作用
    + 父類別在使用介面之後，必須要實作該介面功能內容！
    + 子類別在繼承父類別之後，如想要改變介面功能內容，必須使用覆寫的方式！
    + 父類別若不想實作介面方法，子類別又需要定義介面功能，可以將父類別抽象化，即可不用實作介面方法！
    + 子類別繼承抽象父類別之後，必須要實作父類別的介面方法！
  + 例 : 修改 dog.php 
    ```php
    <?php
    include "Bark.php";
    abstract class dog implements Bark {
       // 設定狗的屬性
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
       // 修改狗叫的功能
       public function Bark(){
         //這裡保持空白
       }

       public function __destruct(){
         echo "狗狗回家了...";
       }
    }
    ?>
    ```
    ----
  + 修改 Poodle.php
    ```php
    <?php
    include "dog.php";

    class Poodle extends dog{
      protected $size;

      public function __construct($name,$color,$style,$size){
        parent::__construct($name,$color,$style);
        $this->size = $size;
      }
      // 實作父類別的狗叫 function
      public function Bark(){
        echo "狗叫...但小聲....";
        //呼叫父類別的 dogBark()
      }
    }
    ?>
    ```
    ------
  + 修改 demo2.php
    ```php
    <?php
      include "Poodle.php";

      $mydog = new Poodle("Windy","白色","貴賓狗",30);
      //修改此行
      echo $mydog->Bark();
    ?>
    ```

+ 靜態屬性(static)
  + 作用
    + 用於不會改變的類別屬性與方法
    + 不需要實例化產生物件，直接呼叫類別即可使用
  + 例 : MathRate.php
    ```php
    <?php
    class MathRate{
      public static function ComplexRate($principal,$yearRate,$period,$years){
         $result = 0;
         $result =  $principal * pow((1 + ((float)$yearRate/$period)),($period*$years));
         return $result;
      } 
    }
    ?>
    ```
    -----
  + demo4.php
    ```php
    <?php
      include "MathRate.php";
      echo MathRate::ComplexRate(1000,0.18,12,3);
    ?>
    ```

+ 多型(Polymorphism)
  + 有繼承的關係才能使用多型
  + 利用有相同父類別的關係，進行不同子類別的方法實作，產生不同的結果！
  + 例 : demo5.php
    ```php
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
      public function move()
      {
          echo '飛';
      }
    }
    class Action{
      public function actionMove(Animal $obj)
      {
          $obj->move();
      }
    }
    
    $dog = new Dog();
    $bird = new Bird();
    $action = new Action();
    $action->actionMove($dog);
    $action->actionMove($bird);
    ?>
    ```

+ 多載(overloading)
  + PHP 無法像其他物件導向程式語言，可以利用相同名稱，不同參數屬性值來實作多載功能！
  + PHP 利用自定義的 Magic methods 來實作多載功能！
  
  + 屬性多載的 magic function :
    + __set(): 若有屬性名稱是設定未定義或無法讀取的，就「設定」對應的屬性值！
    + __get(): 若有屬性名稱是設定未定義或無法讀取的，就「取得」對應的屬性值！
    + __isset(): 查詢某個屬性是否有被定義！
    + __unset(): 解除某個屬性定義值！
    + 例 : Person.php
      ```php
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
            // 取得屬性名稱的值
            public function __get($name){
              return $name;
            }
            // 判斷是否有該屬性參數   
            public function __isset($name){
              return $name;
            }
            // 取消該屬性
            public function __unset($name){
              return $name;
            }
          }
          
          $person = new Person();
          //Person 類別沒有 name 這個屬性名稱
          //PHP_EOL 空隔或是換行
          $person->name = 'PHP';
          echo $person->name.PHP_EOL;
          // sex 這個屬性是無法取得的
          echo $person->sex.PHP_EOL;
          echo isset($person->address);
          unset($person->name);
      ?>
      ```

    + 方法多載的 magic functions :
      + __call() : 當呼叫一個未定義的物件方法時，會呼叫本法函數！
      + __callStatic() : 當呼叫一個未定義的靜態物件的方法時，會呼叫本法函數！
      + 例 : Shape.php
        ```php
        <?php
        class Shape {
          const PI = 3.142 ;
          // name 是方法名稱,arg 則是陣列名稱
          function __call($name,$arg){
            if($name == 'area')
              switch(count($arg)){
                case 0 : return 0 ;
                //self 指物件自己
                case 1 : return self::PI * $arg[0] ;
                case 2 : return $arg[0] * $arg[1];
              }
          }
          function __callStatic($name,$arg){
            return array(3,5);
          }
        }
        $circle = new Shape();
        echo $circle->area(3);
        $rect = new Shape();
        echo $rect->area(8,6);
        echo Sharp::hello()[1];
        ?>
        ```

+ 匿名類別
  + 有些類別用完即丟，沒有需要一直存在，即可使用匿名類別，減輕程式的複雜程度！
  + 例 : Application.php
    ```php
    <?php
    interface Logger {
      public function log(string $msg);
    }
    class Application {
      private $logger;
      public function getLogger(): Logger {
        return $this->logger;
      }
      public function setLogger(Logger $logger) {
        $this->logger = $logger;
      }
    }
    $app = new Application;
    // 使用 new class 建立匿名類別
    $app->setLogger(new class implements Logger {
      public function log(string $msg) {
        print($msg);
      }
    });
    
    $app->getLogger()->log("這是一個匿名類別的例子");
    ?>
    ```

#### 參考文獻
