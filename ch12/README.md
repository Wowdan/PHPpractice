### 第十二章 Laravel 與資料庫的結合 I
#### 基本資料庫連線與操作
+ 連接資料庫的設定方式
  + 主要設定檔案 : config/database.php
    + 設定值主要是給予預設值，讓 **env()** 函數方便設定
    + 如果不使用預設值，請修改 **.env** 檔案！
    + **.env** 檔案可由 **.env.example** 檔案複製！
  + 修改 **.env** 檔案內容 :
    ```bash
    # 其它不使用的部份，請用 # 符號註解
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=cars
    DB_USERNAME=peter
    DB_PASSWORD=Aa12345678!
    ```
  + Linux 系統環境需要 mysqlnd 的套件
    ```bash
    # yum install php-mysqlnd
    # systemctl restart php-fpm
    ```

+ 利用 MVC 連接資料庫
  + 新增 CarsController
    ```bash
    # php artisan make:controller CarsController
    ```
  + 修改 app/Http/Controllers/CarsController.php
    ```php
    <?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use App\Http\Controllers\Controller;
    use Route;
    use View;
    class CarsController extends Controller{
        //
        public function index(){
            $customers = DB::select('select * from customers');
            // 可綁定參數
            // $customers = DB::select('select * from customers where Name = :names', ['names' => "Peter"]);
            return View::make('customers',['customers' => $customers]);
        }
    }
    ```
  + 新增 resources/views/customers.blade.php
    ```php
    <?php
    foreach ($customers as $user){
        echo $user->Name;
    }
    ?>
    ```
  + 修改 routes/web.php 檔案
    ```php
    //增加下列一行
    Route::resource('cars','CarsController');
    ```
  + 開啟瀏覽器，輸入網址 http://你的IP/cars

+ 其他的 SQL 語法使用方式
  + Insert 語法
    ```php
    DB::insert('insert into customers (name,addr) values (?, ?)', ['James', 'test rolad 1']);
    ```
  + Update 語法
    ```php
    $affected = DB::update('update customers set Name = "James" where Name = ?', ['Peter']);
    ```
  + Delete 語法
    ```php
    $deleted = DB::delete('delete from customers where Name = ?',['James']);
    ```

#### 使用 Migration 操作資料庫物件
+ Migration 用途
  + 利用 Migration 功能操作資料庫物件，避免手動操作的錯誤！
  + 可記錄對資料庫操作的變更與目前的狀態！
  + 一旦決定要使用 Migration 功能來開發專案，就必須要求其他人也要使用相同方式進行開發工作！
+ Migration 初始化
  + 利用 **.env** 檔案設定，在資料庫內建立一個 migrations 的資料表!
  + 建立過程中，亦對資料庫進行連線測試!
  + 例 : 
    ```bash
    # php artisan migrate:install
    ```
+ 建立 Migration
  + 產生 migration 檔案
    + 例 : 
      ```bash
      # php artisan make:migration create_customers_table
      ```
      + 每個被 make:migration 指令所建立的檔案，檔名會被加上時間戳記
      + 每個檔名會被轉換成相對應的類別名稱，例 : CreateCustomersTable
      + 指令後方，可以加上 --create={資料表名稱}，自動產生建立資料表的 Schema
      + 指令後方，可以加上 --table={資料表名稱}，自動產生修改資料表的 Schema
  + 編寫 migration 檔案
    + 例 :  database/migratins/(一堆時間)_create_customers_table
      ```php
      <?php
      use Illuminate\Database\Migrations\Migration;
      use Illuminate\Database\Schema\Blueprint;
      use Illuminate\Support\Facades\Schema;
      class CreateCustomersTable extends Migration
      {
        public function up()
        {
          Schema::create('customers', function (Blueprint $table)
          {
            //$table->bigIncrements('id'); 這欄位會形成 Primary Key
            $table->bigIncrements('id');
            $table->char('Cusid',100)->unique()->index();
            $table->char('Name',50)->index();
            $table->char('Address',255);
            $table->char('Phone',10)->index();
            //協助建立追踪的時間
            $table->timestamps();
          });
        }
        
        public function down()
        {
          Schema::dropIfExists('customer');
        }
      }
      ```
      + up() : 當執行 **php artisan migrate** 指令時，即會呼叫該方法，建立資料表!
      + down() : 當執行 **php artisan migrate:rollback** 指令時，即會呼叫該方法，還原資料庫結構！
      + 本張表格 customers 內容 :
        |Field|Type|Null|Key|Default|Extra|
        |:---:|:---:|:---:|:---:|:---:|:---:|
        |Cusid|varchar(10)|NO|PRI|NULL||
        |Name|varchar(50)|NO|INDEX|NULL||
        |Address|varchar(255)|YES||NULL||
        |Phone|varchar(10)|NO|INDEX|NULL||

+ 操作 Migration 指令
  + 執行 migrate 指令，建立資料表
    ```bash
    # php artisan migrate
    ```
  + 查看 migrate 狀況
    ```bash
    # php artisan migrate:status
    ```
  + 回復到上一個版本的資料庫結構
    ```bash
    # php artisan migrate:rollback
    ```
  + 回復到最初的資料庫結構
    ```bash
    # php artisan migrate:reset
    ```
  + 重設資料庫結構到現在這個資料庫結構
    ```php
    # php artisan migrate:refresh
    ```

+ Schema 類別
  + 針對資料庫進行操作
    |方法名稱|說明|操作實例|
    |:---|:---|:---|
    |create|建立資料表|Schema::create('資料表名稱',function(Blueprint $table){});|
    |table|對資料表進行作動|Schema::table('資料表名稱',function(Blueprint $table){});|
    |rename|更新資料表名稱|Schema::rename('舊資料表名稱','新資料表名稱');|
    |drop|刪除資料表|Schema::drop('資料表名稱');|
    |dropIfExists|如果資料表存在，則刪除該資料表|Schema::dropIfExists('資料表名稱');|

+ Blueprint 操作資料表方法
  + 針對資料表欄位資料型態設定
    + increments('欄位名稱') : 建立一個正整數型態、並且自動遞增的欄位！預設成為主鍵！
    + boolean('欄位名稱') : 建立一布林值資料型態欄位！
    + char('欄位名稱',資料長度) : 建立一文字資料型態欄位，並且設定長度！
    + date('欄位名稱') : 建立一日期資料型態欄位！
    + dateTime('欄位名稱') : 建立一日期時間資料型態欄位！
    + double('欄位名稱',總位數,小數位數) : 建立一 Double 浮點數資料型態欄位！
    + float('欄位名稱') : 建立一 Float 浮點數資料型態欄位！
    + integer('欄位名稱') : 建立一 Integer 整數資料型態欄位！
    + string('欄位名稱',資料長度) : 建立一 Varchar 文字資料型態欄位！
    + text('欄位名稱') : 建立一 Text 文字資料型態欄位！
    + timestamp('欄位名稱') : 建立一 Timestamp 時間戳記資料型態欄位！
    + timestamps() :  建立名為 created_at 及 updated_at 兩個時間戳記資料型態欄位！
    + softDeletes() : 建立名為 deleted_at 時間戳記資料型態欄位！

  + 在資料表欄位資料型態設定函數後，可以修改欄相關設定
    + ->after('欄位名稱') : 表示該欄位的順序，應位於指定欄位後面！
    + ->autoIncrement() : 為此欄位加上自動增值功能！
    + ->comment('說明內容') : 為此欄位加上註解說明！
    + ->default(預設值) : 設定此欄位預設值！
    + ->first() : 將此欄位設為資料表第一個欄位！
    + ->nullable() : 此欄位可以為空值
    + ->unsigned() : 此欄位只有正整數資料型態
    + ->primary() : 此欄位設為主鍵！
    + ->unique() : 此欄位的值不可有重複！
    + ->index() : 此欄位值設成索引鍵！

  + 維護資料表欄位的其他方法
    + dropColumn('欄位名稱') : 刪除指定欄位
    + dropTimestamps() : 刪除時間戳記欄位
    + dropsoftdeletes() : 刪除軟刪除戳記欄位
    + dropPrimary('欄位名稱') : 刪除指定欄位的主鍵設定
    + dropUnique('欄位名稱') : 刪除指定欄位不可重複資料的設定
    + dropIndex('欄位名稱') : 刪除指定欄位索引鍵的設定

#### 使用 Eloguent 查詢資料庫內容
+ Eloguent 概述
  + ORM (Object-Relational Mapping)是指將關聯式資料庫映射至物件的資料抽象化技術
    + 把資料庫中的資料變成一個物件(class)，讓寫程式時可以透過操作這個物件，來存取資料庫中的資料
  + Eloguent 在 Laravel 中，實做了 ORM 這個技術！
  + 每個資料庫中的資料表，都會對應到一個Eloquent Model，當建立好對應的Model後，即可透過這個Model存取資料表中的資料。

+ Eloguent 建立過程
  + 建立 Model
    + 例 : 建立 Customer 模組，對應 Customers 資料表
      ```bash
      # php artisan make:model Customer
      ```
    + Laravel 中的 Eloguent 命名規則
      + 資料表使用**英文複數**；Model使用**英文單數**
      + 資料表用**小寫**，單字間用**蛇底式命名(Snake Case)**；Model用首字**大寫**，**大駝峰式命名(Upper Camel Case)**

  + 編寫 app/Customers.php 檔案
    + 例 : 設定對應的資料表
      ```php
      <?php
      namespace App;
      
      use Illuminate\Database\Eloquent\Model;
      
      class Customer extends Model{
        //定義相關連結的資料表
        //如果有依照命名規則，此行程式不必撰寫
        protected $table = 'customers';
        
        //定義主鍵的欄位
        //如果有依照命名規則，此行程式不必撰寫
        protected $primarykey = 'id';
        
        //如果沒有設定 created_at 與 updated_at欄位，則可以設成 false
        public $timestamps = true;

      }
      ``` 

  + 修改 app/Http/Controllers/CustomerController.php
    ```php
    <?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Route;
    use View;
    use App\Customer;
    class CustomerController extends Controller
    {
        public function index(){

           $customers = Customer::all();
           return View::make('board',['customers' => $customers]);
        }
    }
    ```
    + 可以追加一些常見的 SQL 語句
      + 例 :
        ```php
        $customers = Customer::where('Name', '=', 'Peter') // 取 Name 為 Peter 
               ->orderBy('Name', 'desc') // 根據price由高到低排列
               ->take(10) // 只取前10筆資料
               ->get();
        ```

  + 修改 resources/views/board.blade.php
    ```php
    @extends('layouts.master')
    @section('title','客戶列表')
    @section('content')
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">客戶列表</div>
          <div class="card-body p-1">
            <table class="table table-hover m-0">
              <thead class="thead-darty">
                <tr>
                  <th>客戶編號</th>
                  <th>客戶姓名</th>
                  <th>客戶電話</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach ($customers as $customer){
              ?>
                <tr>
		              <td><?php echo $customer->Cusid; ?></td>
		              <td><?php echo $customer->Name; ?></td>
                  <td><?php echo $customer->Phone; ?></td>
                </tr>
                <?php }  ?>
              </tbody>
            </table>
          </div>  
        </div>
      </div>
    </div>
    @stop
    ```
  + 開啟瀏覽器，輸入網址 http://你的IP/customer

+ Eloquent 中 Model 的常見屬性值列表
  |屬性名稱|說明|
  |:---|:---|
  |$table|定義對應的資料表，例 : protected $table = 'customers';|
  |$primaryKey|指定資料表中的主鍵欄位，例 : protected $primaryKey = 'id';|
  |$incrementing|Elogquent預設欄位名稱 id ，為自動遞增的型態！可以設定成 false 來取消此型態！|
  |$keyType|設定資料表主鍵的資料型態|
  |$timestamps|預設值會開啟，建立 created_at 及 updated_at 兩個欄位！不使用時，在 migration 檔案中刪去 timestamps()之外，還必需將此屬性設定成 false !!|
  |$dateFormat|定義 Eloquent 中的時間儲存格式！例 : protected $dateFormat = 'Y-m-d';|
  |$fillable|定義可批量寫入的欄位|
  |$guarded|定義不可批量寫入的欄位|
  |$hidden|定義輸出資料成為陣列時，隱藏該資料|
  |$visible|定義輸出資料成為陣列時，顯示資料|

+ Eloquent 中常見的查詢類方法
  + where() : 查詢符合條件的所有項目！
    + 例 :
      ```php
      Customer::where('Name','Peter')->get();
      Customer::where('Birthday','>=','1970')->get();
      ```
  + ordeyBy() : 對目標欄位排序
    + 例 :
      ```php
      Customer::orderBy('Name','desc')->get();
      ```

+ Eloquent 資料取出的方法
  + all() : 取出所有的資料
    + 例 :
      ```php
      Customer::all();
      ```
  + get() : 取出設定條件查詢的結果
    + 例 :
      ```php
      Customer::where('Name','like','%er%')->get();
      Customer::get();
      ```
  + find() : 使用 Primary Key 取出資料
    + 例 : 
      ```php
      Customer::find('10');
      Customer::find(['1','3','5']);
      ```
  + first() : 取得第一筆資料
    + 例 :
      ```php
      Customer::orderBy('Name','desc')->first();
      ```
  +  findOrFail() : 找不到資料時，會回傳錯誤例外訊息！
     + 例 :
       ```php
       //只要其中一筆沒找到，就會出現錯誤例外！
       Customer::findOrFail(['1','3','5']);
       ```
  +  firstOrFail() : 找不到資料時，會回傳錯誤例外訊息！
     +  例 :
        ```php
        Customer::orderBy('Name','desc')->firstOrFail();
        ```

+ Collection 物件的方法
  + avg() : 回傳某個欄位的平均值
    + 例 :
      ```php
      Cars::all()->avg('prize');
      ```
  + count() : 計算資料總筆數
    + 例 :
      ```php
      Cars::where('Name','like','%B%')->get()->account();
      ```
  + max() : 回傳某個欄位的最大值
    + 例 :
      ```php
      Cars::all()->max('prize');
      ```
  + min() : 回傳某個欄位的最小值
    + 例 :
      ```php
      Cars::get()->min('prize');
      ```
  + random() : 隨機取一筆資料出來
    + 例 :
      ```php
      Customer::get()->random();
      ```
  + sum() : 計算某個欄位的總和
    + 例 :
      ```php
      Cars::get()->sum('prize');
      ```
  + take() : 只抓取特定數目的資料
    + 例 :
      ```php
      //取前三筆資炓
      Customer::get()->take(3);
      //取最後三筆資料
      Customer::get()->take(-3);
      ```
  + toJson() : 將資料轉成 Json 格式
    + 例 :
      ```php
      Customer::all()->toJson();
      ```
#### 參考文獻
[Database in Laravel](https://dometi.com.tw/blog/laravel-beginner-09/)
[MySQL 8 忘記密碼](https://www.tecmint.com/reset-root-password-in-mysql-8/)
[資料庫: 遷移](https://laravel.tw/docs/5.2/migrations#dropping-indexes)