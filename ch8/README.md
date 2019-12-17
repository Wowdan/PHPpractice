### 第八章 PHP 進階語法II
#### 類別的應用與處理
+ 自動載入
  + PHP 原有的載入方式
    + include : 載入其他的 php 程式檔！當執行錯誤時，不會停止程式運作！
    + include_once : 相同的檔案，只會載入一次！
    + require : 載入其他的 php 程式檔！當執行錯誤時，會停止程式運作！
    + reuqire_once : 相同的檔案，只會載入一次！
  + 缺點 : 若需要載入大量檔案程式，程式碼將會十分難看與難以除錯與管理！
  + PHP Autoload 方式
    + 當須要用到該使用的物件時，才去真正的引入該類別
    + __autoload 用法 :
      + 例 : 有一個目錄 Classes ，裡面有個 Member.php 的檔案，Classe 目錄外面有兩個檔案 autoload.php 以及 index.php
        ```php
        +Classes
        +--Member.php
        -autoload.php
        -index.php
        ```
      + Member.php
        ```php
        <?php
        //這是 Classes/Member.php
        class Member{
          public function getMemberList(){
            echo "print member list...<br>";
          }
        }
        ?>
        ```
      + autoload.php
        ```php
        <?php
        function __autoload($className){
          $filename = __DIR__ . "/classes/" . $className . ".php";
          if (is_readable($filename)){
            require $filename;
          }
        }
        ?>
        ```
      + index.php
        ```php
        <?php
        //這是 index.php
        include_once __DIR__ . "/autoload.php";
        
        $member = new Member();
        $member->getMemberList();
        ?>
        ```
      + 缺點 : __autoload() 不能重覆的被定義！

    + 使用 SPL(Standard PHP Library)
      + spl_autoload :
        + 預設實作 __autoload() magic function
        + 當 spl_autoload_register() 沒有定義或是沒有帶任何參數的時候，預設會採用 __autoload() 這個 function
      + spl_autoload_register
        + 能夠註冊自行定義的 autoload function
        + 當 spl_autoload_register() 有註冊之後，__autoload() 將會失效，必需自己手動將 __autoload() 註冊，才能使用。
      + 例 : 在原來的範例目錄內，增加 first 以及 second 這兩個目錄以及 First.php 與 Second.php 兩個檔案！另外再新增兩個 firstAutoload.php 以及 secondAutoload.php 檔案！
        ```php
        +Classes
        +--Member.php
        +first
        +--First.php
        +second
        +--Second.php
        -firstAutoload.php
        -secondAutoload.php
        -autoload.php
        -index.php
        ```
      + First.php
        ```php
        <?php
        //這是 first/First.php
        class First{
          public function doSomething(){
            echo "I am first class...<br>";
          }
        }
        ?>
        ```
      + Second.php
        ```php
        //這是 second/Second.php
        class Second{
          public function doSomething(){
            echo "I am second class...<br>";
          }
        }
        ?>
        ```
      + firstAutoload.php
        ```php
        <?php
        //這是 firstAutoload.php
        function firstAutoload($className){
          $filename = __DIR__ . "/first/" . $className . ".php";
          if (is_readable($filename)){
            require $filename;
          }
        }
        //向 spl_autoload 註冊這個方法的名稱
        spl_autoload_register('firstAutoload');
        ```
      + secondAutoload.php
        ```php
        <?php
        //這是 secondAutoload.php
        function secondAutoload($className){
          $filename = __DIR__ . "/second/" . $className . ".php";
          if (is_readable($filename)){
            require $filename;
          }
        }
        //向 spl_autoload 註冊這個方法的名稱
        spl_autoload_register('secondAutoload');
        ```
      + 修改 index.php
        ```php
        <?php
        //修改後的 index.php
        include_once __DIR__ . "/firstAutoload.php";
        include_once __DIR__ . "/secondAutoload.php";
        
        $first = new First();
        $first->doSomething();
        
        $second = new Second();
        $second->doSomething();
        ?>
        ```
      + 缺點 : 每新增一個目錄，就需要寫一個 autoload 檔案！不好管理！
      + 改進方式 : 寫一個 allAutoload.php，再使用 array、foreach 導入！
        ```php
        <?php
        //這是 allAutoload.php
        function allAutoload($className){
          $folders = array(
            __DIR__ . "/first/",
            __DIR__ ."/second/",
          );
        
          foreach ($folders as $folder){
            $fileName = $folder . $className . ".php";
            if (is_readable($fileName)){
              require $fileName;
            }
          }
        }
        //註冊
        spl_autoload_register('allAutoload');
        ```
      + 再次修改 index.php
        ```php
        <?php
        //又修改了　index.php
        include_once __DIR__ . "/allAutoload.php";
        $first = new First();
        $first->doSomething();
        
        $second = new Second();
        $second->doSomething();
        ?>
        ```
      + 缺點 : 每次新增一個 class 目錄，就要異動一次 autoload 檔案！

+ 命名空間(Namespace)
  + PSR 規範 : PHP-FIG 提出的規範，目的是讓 PHP 開發者在撰寫時有一個建議規範可遵循，使得開發者間可進行有效溝通與開發！
  + PSR-4 規範了一套 namespace 統一作法，包含了原有的 PSR-0 所規範的 autoload 作法！
  + 利用Composer 來進行 autoload 可提昇編輯效率！
  + PHP 檔案內的關鍵字 :
    + namespace : 定義類別的完整類別名稱
    + use : 導入需要使用的類別名稱
  
  + PSR-4 正確的命名空間，其完整的類別名稱語法如下 :
    ```php
    \<NamespaceName>(\<SubNamespaceNames>)*\<ClassName>
    ```
    + 完整的類別名稱(fully qualified class name)必須有最高層級(top-level)的命名空間(namespace)，通常稱這個命名空間為「供應商命名空間(vendor namespace)」。
    + 完整的類別名稱可以有一個或多個子命名空間。
    + 一個完整的類別名稱必須以類別名稱結束。
    + 在完整的類別名稱中，底線沒有其他意義。
    + 完整的類別名稱可以由英文字母大小寫組合而成。
    + 所有的類別名稱必須是有區分大小寫的。
  
  + 重點 :
    + 命名空間 + 類別名稱 = 路徑 + 檔名.php
    + 命名空間、類別，都需要開頭大寫
    + 底線不要拿來當作分類，例如 : Like_Book.php、Like_Movie.php，應該改成路徑 Like/Book.php、Like/Movie.php
  
  + 實作範例:
    + 安裝 Composer :(開發環境才需要裝！Windows 用戶請看參考文獻安裝)
      ```bash
      # yum install wget
      # cd /usr/share/nginx/html
      # wget https://getcomposer.org/installer -O composer-installer.php
      # php composer-installer.php --filename=composer --install-dir=/usr/local/bin
      # composer --version
      ```

    + 建立測試用目錄 :
      ```php
      +Hello
      ++public
      ++-index.php
      ++src
      +++Cars
      +++-Car.php
      ++vendor (該目錄由 composer 自建，一開始不用手動建立)
      +++composer
      ++-autoload.php
      +-composer.json
      ```

    + 編寫 composer.json
      ```json
      {
        "autoload": {
          "psr-4": {
            "Cars\\": "src/Cars"
          }
        }
      }
      ```

    + 初次建立名稱空間
      ```bash
      # composer dump-autoload
      ```

    + 開始建立 PHP 類別程式
      + Cars/Car.php
        ```php
        <?php
        namespace Cars;

        class Car{

          protected $name;

          public function setName($name){
            $this->name = $name;
            return "completed...";
          }

          public function getName(){
            return $this->name;
          }
        }
        ?>
        ```
      + public/index.php
        ```php
        <?php
        require_once '../vendor/autoload.php';

        use \Cars\Car;
        $mycar = new Car();
        $mycar->setName("Ford...");
        echo $mycar->getName();
        ?>
        ```

      + 使用瀏覽器 http://你的ＩＰ/Hello/public/index.php

    + 增加新的類別 : Customers
      + 在 src 目錄下建立新的目錄 Customers
        ```bash
        # mkdir /usr/share/nginx/html/Hello/src/Customers
        ```

      + 修改 composer.json
        + 加入 Customers 路徑的對應
          ```json
          {
            "autoload": {
              "psr-4": {
                "Cars\\": "src/Cars",
                "Customers\\": "src/Customers"
              }
            }
          }
          ```

        + 再執行一次 composer
          ```bash
          # composer dump-autoload
          ```

        + 開始新增新的類別 Customer
          + 在 src/Customers 目錄下，新增 Customer.php
            ```php
            <?php
            namespace Customers;

            class Customer{
              protected $cname;
              public function setName($cname){
                $this->cname = $cname;
                return "completed...";
              }
              
              public function getName(){
                return $this->cname;
              }
            }
            ?>
            ```

          + 修改 index.php 檔案內容
            ```php
            <?php
            require_once '../vendor/autoload.php';
                
            use Cars\Car;
            use Customers\Customer;
                    
            $mycar = new Car();
            $mycar->setName("Ford...");
            echo "My Car: ".$mycar->getName();
            echo "<br />";
            $myprofile = new Customer();
            $myprofile->setName("Peter");
            echo "My Name: ".$myprofile->getName();
            ?>
            ```

          + 在 Customers 下增加子目錄 Block
            ```bash
            # cd /usr/share/nginx/html/Hello/src
            # mkdir Customers/Block
            ```
          
          + 在 Block 目錄下，增加一個 Blocklist.php
            ```php
            <?php
            namespace Customers\Block;
            
            use Customers\Customer;
            
            class Blocklist extends Customer {

              protected $state;
                    
              public function setState($state){
                $this->state = $state;
                return "Complete...";
              }
                    
              public function getState(){
                return $this->state;
              }
            }
             ?>
            ```

          + 修改 index.php 檔案內容
            ```php
            <?php
            require_once '../vendor/autoload.php';
                
            use Cars\Car;
            use Customers\Customer;
            use Customers\Block\Blocklist;        
                    
            $mycar = new Car();
            $mycar->setName("Ford...");
            echo "My Car: ".$mycar->getName();
            echo "<br />";
            $myprofile = new Customer();
            $myprofile->setName("Peter");
            echo "My Name: ".$myprofile->getName();
            echo "<br />";
            $mystate = new Blocklist();
            $mystate->setState("Forzien...");
            echo $mystate->getState();
            ?>
            ```

          + 使用瀏覽器 http://你的ＩＰ/Hello/public/index.php

+ 特徵(Trait)
  + Trait 與抽象類別相似，無法使用 new 來產生物件(被實例化)!
  + 因為 PHP 只能單一繼承，所以無法跨多個類別使用這些類別內的方法！
  + 為了減少程式碼的重複撰寫，所以 PHP 使用 Trait 來克服這個問題！
  + 使用 Trait 可以讓 PHP 實現單一類別(Singleton)的使用！
  
  + 單一 Trait 使用範例 :
    + oneTrait.php
      ```php
      <?php
      class Base {
        public function sayHello() {
          echo 'Hello ';
        }
      }
      trait SayWorld {
        public function sayHello() {
          parent::sayHello();
          echo 'World!';
        }
      }
      class MyHelloWorld extends Base {
        use SayWorld;
      }
      
      $o = new MyHelloWorld();
      $o->sayHello();
      ?>
      ```

  + 多個 Trait 使用範例 :
    + multiTrait.php
      ```php
      <?php
      trait Hello {
        public function sayHello() {
          echo 'Hello ';
        }
      }
      trait World {
        public function sayWorld() {
          echo 'World';
        }
      }
      class MyHelloWorld {
        use Hello, World;
        public function sayExclamationMark() {
          echo '!';
        }
      }
      $o = new MyHelloWorld();
      $o->sayHello();
      $o->sayWorld();
      $o->sayExclamationMark();
      ?>
      ```

    + integrateTrait.php
      ```php
      <?php
      trait Hello {
        public function sayHello() {
          echo 'Hello ';
        }
      }
      trait World {
        public function sayWorld() {
          echo 'World';
        }
      }
      trait HelloWorld{
        use Hello, World;
      }
      class MyWorld{
        use HelloWorld;
      }
      $world = new MyWorld();
      echo $world->sayHello() . " " . $world->sayWorld(); //Hello World
      ?>
      ```
  + 優先序問題
    + Trait 內可以使用 overwrite 功能來覆蓋父類別有的功能！
    + 優先序的範例 : orderTrait.php
      ```php
      <?php
      trait Hello{
        function sayHello() {
          return "Hello";
        }
        function sayWorld() {
          return "Trait World";
        }
        function sayHelloWorld() {
          echo $this->sayHello() . " " . $this->sayWorld();
        }
        function sayBaseWorld() {
          echo $this->sayHello() . " " . parent::sayWorld();
        }
      }
      
      class Base{
        function sayWorld(){
          return "Base World";
        }
      }
      class HelloWorld extends Base{
        use Hello;
        function sayWorld() {
          return "World";
        }
      }
      $h =  new HelloWorld();
      $h->sayHelloWorld(); // Hello World
      ?>
      ```
 
  + Trait 的衝突與別名 : 使用 insteadof 與 as
    + 利用 insteadof 來解決不同 Trait 但相同方法名稱的問題
    + 例 : 有一衝突的範例 confuse.php
      ```php
      <?php
      trait Game{
        function play() {
          echo "Playing a game";
        }
      }
      trait Music{
        function play() {
          echo "Playing music";
        }
      }
      
      class Player{
        use Game, Music;
      }
      $player = new Player();
      $player->play();
      ?>
      ```
      + 以上範例有兩個 Trait ，有相同的方法名稱 play()!在使用當下，就會發生衝突！
    + 修改後的  confuse.php 如下 :
      ```php
      <?php
      trait Game{
        function play() {
          echo "Playing a game";
        }
      }
      trait Music{
        function play() {
          echo "Playing music";
        }
      }
      
      class Player{
        use Game, Music{
          //將 Game 的 play 別名成 gamePlay
          Game::play as gamePlay;
          //使用 Music 的 play 功能，取消 Game 的 play 功能！
          Music::play insteadof Game;
        }
      }
      $player = new Player();
      $player->play();
      $player->gamePlay();
      ?>
      ```
  
  + Trait 其它功能
    + 利用 Trait 獨特的使用功能，可以取得 private 權限的類別屬性值
    + 例 : getPritrait.php
      ```php
      <?php
      trait Message {
        function alert() {
          echo $this->message;
        }
      }
      class Messenger {
        use Message;
        private $message = "This is a message";
      }
      
      $messenger = new Messenger;
      $messenger->alert(); //This is a message
      ?>
      ```
    + 利用 Trait 內可抽象化方法，強迫使用該 Trait 的類別，實作該抽象方法！
    + 例 : abtractTrait.php
      ```php
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
      $messenger->alert(); //Custom Message
      ?>
      ```
  + Trait 的 use 與類別導入的 use 是不同的功能
    + Trait 的 use : 置放於 class 內部！
    + 類別導入的 use : 置放於 class 外部！

#### 錯誤與例外處理
+ 掌握錯誤與例外
  + 避免非預期的結果干擾使用者！
  + 強化安全性，避免惡意的使用者查覺系統問題！
  + 在預期錯誤發生時，仍可導入正常處理流程！

+ 錯誤的情況處理分類
  + die 況狀 : 利用 die() 函數處理錯誤情形，將程式導出並且中止執行！
  + 客製化錯誤 : 發生錯誤情形時，導入自製的處理程序！
  + 錯誤報告 : 將錯誤情形報告出來，寫入檔案或是資料庫！此種報告可協助找出錯誤問題，加以處理！
  + 例 : 自行客製化錯誤的方式 
    ```php
    <?php
    function my_error_handler($error_no, $error_msg) {
      echo "Opps, something went wrong:";
      echo "Error number: [$error_no]";
      echo "Error Description: [$error_msg]";
    }
    set_error_handler("my_error_handler");
    echo (5 / 0);
    ?>
    ```
+ 錯誤與例外的不同
  + 例外是可以抛出與接收處理，但錯誤則是無法恢復！
  + 例外可以使用物件導向的方式來掌握與處理！
  
+ 例外的情況處理分類
  + 注意(Notice): 不嚴重的問題，程式也不會停止
  + 警告(Warning): 程式碼有錯誤，但程式亦不會停止執行
  + 致命錯誤 (Fata Error): 遇上嚴重錯誤，程式停止執行

+ try...catch 敘述
  + 語法 :
    ```php
    try {
      可能會發生錯誤的程式碼;
    } catch(Exception $e){
      處理例外的程式碼;
    }
    ```
  + Exception 是 PHP 處理例外的類別
    + 屬性值有兩個，一個是訊息，另一個則是代號值
    + 訊息會描述程式產生錯誤的地方
    + 代號值為錯誤代碼
    + 使用的語法 : 可以自行抛出 Exception
      ```php
      throw new Exception('Error Message', 100);
      ``` 

+ 抛出例外與接收
  + 當程式抛出例外時，程式會自動暫停，接下來的程式碼也不會運作！
  + 例 : throwExp.php
    ```php
    <?php
    function check($num){
      if ( $num == 0 ){
        throw new Exception('num can not be 0', 100);
      }
      return $num;
    }

    try{
      echo check(0);
    } catch (Exception $e){
      echo "Error Message: ".$e->getMessage()."<br />";
      echo "Error Code: ".$e->getCode()."<br />";
    }
    ?>
    ```

+ Exception 類別的繼承
  + 利用繼承 Exception 類別，自訂例外處理的屬性與方法！
  + 例 : selfExp.php
    ```php
    <?php
    class EmailFormatException extends Exception {
      function printMessage(){
        echo "例外訊息:" . $this->getMessage() . "<br />";
      }
    }
    function checkEmail($email){
      if (!strpos($email,"@"))
        throw new EmailFormatException("E-mail需要包含'@'");
    }
    try {
      checkEmail('gmail.com');
    } catch (EmailFormatException $e){
      $e->printMessage();
    }
    ?>
    ```

+ 多層次的例外處理
  + 執行程式時，可能會發生多種情況的例外，可以寫多個 catch 來補抓例外！
  + 例 :
    ```php
    <?php
    class DivideByZeroException extends Exception {};class DivideByNegativeException extends Exception {};
    function process($denominator) {
      try	{
        if ($denominator == 0) {
          throw new DivideByZeroException();
        }	else if ($denominator < 0) {
          throw new DivideByNegativeException();
        }	else {
          echo 25 / $denominator;
        }
      }	catch (DivideByZeroException $ex)	{
        echo "DIVIDE BY ZERO EXCEPTION!";
      }	catch (DivideByNegativeException $ex)	{
        echo "DIVIDE BY NEGATIVE NUMBER EXCEPTION!";
      }	catch (Exception $x) {
        echo "UNKNOWN EXCEPTION!";
      }
    }
    process(0);
    ?>
    ```
    
#### 參考文獻
+ [Eric G. Huang 不像樣工程師](http://justericgg.logdown.com/posts/196891-php-series-autoload)
+ [php 的物件](https://www.camdemy.com/media/23734)
+ [PSR 規範](https://www.php-fig.org/psr/)
+ [PHP PSR-4 Autoloader 機制](http://blog.tonycube.com/2016/09/php-psr-4-autoloader.html)
+ [php – Composer – 非常簡單的使用 psr-4 來建立自動讀取類別](https://jsnwork.kiiuo.com/archives/2618/php-composer-%E9%9D%9E%E5%B8%B8%E7%B0%A1%E5%96%AE%E7%9A%84%E4%BD%BF%E7%94%A8-psr-4-%E4%BE%86%E5%BB%BA%E7%AB%8B%E8%87%AA%E5%8B%95%E8%AE%80%E5%8F%96%E9%A1%9E%E5%88%A5/)
+ [PHP Trait 使用指南](https://learnku.com/php/t/37694)
+ [PHP error tutorial](https://www.guru99.com/error-handling-and-exceptions.html)
+ [Composer安裝教學](https://ithelp.ithome.com.tw/articles/10190770)