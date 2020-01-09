### 第十一章 Laravel 的ＭＶＣ II
#### Controller 的使用
+ Controller 的用途
  + 用來處理網頁的要求邏輯！
  + Controller可以將原先routes中要求處理邏輯加以分類組織，成為一個個獨立的class！
  + 
+ 建立 Controller
  + 透過 artisan 指令，建立需要使用的 controller !!
  + 語法 :
    ```bash
    # php artisan make:controller {Controller Name} --{option 1} --{option 2} ....
    ```
  + 例 : 建立一個產品相關的 Controller
    ```bash
    # php artisan make:controller ProductionController --resource --model=Product
    ```
    + --resource : 自動建立好 CRUD 方法！包含有 : index, create, store, show, ,edit, update, destroy 幾個方法!
    + --model : 自動連結好 Model
    + 在 app/Http/Controllers目錄下，會有一個檔案 : ProductionController.php
      ```php
      <?php
      namespace App\Http\Controllers;
      use App\Product;
      use Illuminate\Http\Request;
      class ProductionController extends Controller{
          public function index(){}
          public function create(){}
          public function store(Request $request){}
          public function show(Product $product){}
          public function edit(Product $product){}
          public function update(Request $request, Product $product){}
          public function destroy(Product $product){}
      }
      ```

+ 由 Route 轉發要求給 Controller
  + Controller 的目的就是為了要處理要求！
  + 利用 Route 把要求轉發給 Controller 處理！
  + 例 : 利用Laravel 預設的 router 檔案 routes/web.php
    ```php
    <?php
    // GET product的要求轉發給ProductController的index方法處理
    Route::get('product', 'ProductionController@index');
    // GET product{id}的要求轉發給ProductController的show方法處理，同時會傳遞參數id
    Route::get('product/{id}', 'ProductionController@show');
    // POST product的要求轉發給ProductController的store方法處理
    Route::post('product', 'ProductionController@store');
    ?>
    ```
    或是使用全部轉發的方式 :
    ```php
    <?php
    Route::resource('product', 'ProductionController');
    ?>
    ```
    + nginx 需要做修正 : /etc/nginx/conf.d/default.conf
      ```php
      //所有 root 開頭的設定均要改變
      root /usr/share/nginx/html/專案名稱/public;
      location / {
        try_files $uri $uri/ /index.php?$query_string;
      }
      ```
        + nginx 修正完，需要重新啟動服務
          ```php
          # nginx -t
          # nginx -s reload
          ```
    + 利用 artisan 檢查路由表
      ```bash
      # php artisan route:list
      ```
    + 打開瀏覽器，輸入網址 : http://你的IP/product

+ 路由可以指定 Controller 處理七種不同要求
  |HTTP verb|URI|動作|路由名稱|
  |:---|:---|:---|:---|
  |GET|/product|index|product.index|
  |GET|/product/create|create|product.create|
  |POST|/product|store|product.store|
  |GET|/product/{photo}|show|product.show|
  |GET|/product/{photo}/edit|edit|product.edit|
  |PUT/PATCH|/product/{photo}|update|product.update|
  |DELETE|/product/{photo}|destroy|product.destroy|

  + 只限定處理部份要求 :
  + 例 :
    ```php
    //只允許 index, show
    Route::resource('product', 'ProductController', ['only' => ['index', 'show']]);
    //排除 create,store,update,destroy
    Route::resource('product', 'ProductController', ['except' => ['create', 'store', 'update', 'destroy']]);
    ```

+ Controller 命名空間
  + Controller 與 Route 所使用的基礎命名空間，預設位於 App\Http\Controllers
  + 需要建立或調整 Controller 的命名空間，可利用 artisan 在建立 Controller 時，一併建立
    + 例 :
      ```bash
      # php artisan make:controller Hello/DemoController
      ```
      + 在 app/Http/Controllers/Hello 路徑下，會有一個 DemoController.php 檔案被建立
        ```php
        <?php
        namespace App\Http\Controllers\Hello;
        use App\Http\Controllers\Controller;
        use Illuminate\Http\Request;
        class HelloDemoController extends Controller{
          // 輸入下列程式碼
          public function index(){
            return 'Hello Controller';
          }
        }
        //真的沒有 ?> 這個符號
        ```
      + 在路由上註冊上述 Controller : routes/web.php
        ```php
        <?php
        //加入下列這一行，其它行不要刪掉
        Route::get('hello','Hello\DemoController@index');
        ?>
        ```
      + 也可以利用路由群組中的 namespace 設定， 統一調整群組中的命名空間
        ```php
        <?php
        Route::group(['namespace'=>'Hello'], function(){
          Route::get('hello','DemoController@index');
        });
        ?>
        ```
      + PS: 如果刪除了整個專案目錄，記得要重新下載並且製造新的 key
        ```bash
        # git pull origin master
        # php artisan key:generate
        ```
  
#### View 與 Blade 的使用
+ Laravel 的網頁根目錄
  + 位於專案目錄下的 public 子目錄內
    + 該目錄放置靜態資源檔案，例如 : 圖片檔、CSS 檔、JavaScript 檔案
      |名稱|檔案類型|說明|
      |:---|:---|:---|
      |css|目錄|放置 CSS 檔案用|
      |js|目錄|放置 Javascript 檔案用|
      |svg|目錄|放置 svg 檔案用|
      |.htaccess|檔案|給 Apache 套件使用的 Web 站台設定檔|
      |favicon.ico|檔案|網站用的小圖示|
      |index.php|檔案|站台的進入點網頁|
      |robots.txt|檔案|設定不給爬蟲抓取的檔案與目錄|

+ Laravel 的 View 目錄
  + 在 「專案目錄/resources/views」子目錄下
+ 基本使用 View 的方式
  + 由 route 檔案直接呼叫，例 : routes/web.php
    ```php
    Route::get('/', function () {
      return view('welcome');
    });
    ```
  + 呼叫語法 :
    ```php
    view('View的名稱') 
    // 相對應的檔案名稱 : View的名稱.blade.php
    ```
  + 例 : 在 routes/web.php 修改一下程式內容
    ```php
    Route::get('/', function(){
      return view('think');
    });
    ```
    ------
    在 resources/views/think.blade.php :
    ```html
    <div class="title m-b-md">
    　　很高興見到你！
    </div>
    ```

+ Blade 樣板引擎
  + 使用樣板引擎的好處 : 
    + 可輕易將網頁拆解成不同的區段
    + 每個區段的網頁可以重複利用
    + 網頁可以被繼承
  + Laravel 內建 Blade 樣板引擎，但可以更換其它的樣板引擎
  + 使用時，請將副檔名定成「 .blade.php 」即可！
  
+ Blade 語法
  + 輸出內容
    |語法|使用說明|
    |:---|:---|
    |{{--註解內容--}}|Blade的註解格式，註解內容不會出現在網頁內容|
    |{!!輸出內容!!}|將內容直接輸出|
    |{{輸出內容}}|將內容利用 PHP 的 htmlentities 方法過濾後輸出|
    + 預設值設定方法 :
      ```html
      {{ $name ?? 'Default'}}
      ```

  + 邏輯控制
    |語法|使用說明|
    |:---|:---|
    |@if(判斷句)<br /> @elseif(判斷句)<br />@else<br />@endif|if 邏輯判斷表示句|
    |@unless(判斷句)<br />@endunless|效果與 if 相同，但是是當判斷句結果為 false 時，才會成立|
    |@switch(變數名稱)<br />@case(值)<br />@break<br />@default<br />@endswitch|switch 邏輯判斷|
    |@isset(變數名稱)<br />@endisset|如果變數存在，就執行內部程式|
    |@empty(變數名稱)<br />@endempty|與 @isset 作法相反|
    |@for(初始值;條件式;變化量)<br />@endfor|for 迴圈|
    |@while(條件式)<br />@endwhile|while 迴圈|
    |@foreach(陣列名稱 as 鍵值)<br />@endforeach|將陣列值全數取出！可以包含鍵名一起使用！@foreach(陣列名稱 as 鍵名=>鍵值)|
    |@forelse(陣列名稱 as 鍵值)<br />@empty<br />@endforelse|與 @foreach 相同作用！差別在於執行前，會先檢查陣列是否為空|

    + for 迴圈內可用 @break 以及 @continue
    + @foreach 與 @forelse 中的 $loop 變數使用方式列表
      |語法|回傳資料類型|使用說明|
      |:---|:---|:---|
      |$loop->index|數值|回傳目前的索引值(從 0 開始計算)|
      |$loop->iteration|數值|回傳目前的索引值(從 1 開始計算)|
      |$loop->remaining|數值|回傳迴圈還剩下多少個元素|
      |$loop->count|數值|回傳全部元素數量|
      |$loop->first|布林值|是否己經是第一個元素|
      |$loop->last|布林值|是否己經是最後一個元素|
      |$loop->depth|數值|表示巢狀迴圈的層數|
      |$loop->parent|物件|取得上一層迴圈的 $loop 變數值|

  + 區塊設定
    |語法|使用說明|
    |:---|:---|
    |@section('名稱')<br />@endsection|使用名稱定義一個區塊，可顯示及繼承內容|
    |@yield('名稱')|定義一個區塊，用來繼承 @section 定義的內容|
    |@include('樣板名稱')|引入樣板名稱的檔案內容|
    |@extends('樣板名稱')|將指定樣板中的區塊及內容繼承過來|
    |@component|類似 @section 功能|

    + @section 語法內容詳解
      |語法|使用說明|
      |:---|:---|
      |@stop|@endsection 的別名|
      |@show|表示該區塊結束，並且顯示！父代用 @show,子代仜用@endsection 或是 @stop|
      |@parent|將原本繼承的區塊內容加入至當前的區塊|

+ Blade 樣板實作
  + 定義共用的區塊
    + 例 : resources/views/partials/head.blade.php
      ```html
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <!-- Responsive meta tag -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      ```
      -------
      resources/views/partials/foot.blade.php
      ```html
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      ```
      -------
      resources/views/partials/nav.blade.php
      ```html
      <nav class="navbar navbar-expand-lg navbar-light navbar-default">
        <div class="container">
          <a href="{{ url('/') }}" class="navbar-brand">
            HelloWorld
          </a>
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a href="{{ action('CustomerController@index') }}" class="nav-link">
                客戶列表
              </a>
            </li>
          </ul>
        </div>
      </nav>
      ```

  + 定義主要樣板網頁檔案
    + 例 : resources/views/layouts/master.blade.php
      ```html
      <!DOCTYPE html>
      <html>
      <head>
        <title>@yield('title')</title>
        @section('head')
          @include('partials.head')
        @show
      </head>
      <body>
        @include('partials.nav')
        <main class="py-4">
          <div class="container">
            @yield('content')
          </div>
        </main>
        @section('foot')
          @include('partials.foot')
        @show
      </body>
      </html>
      ```

  + 定義子樣板網頁檔案
    + 例 : resources/views/board.blade.php
      ```html
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
                    <tr>
                      <td>A001</td>
                      <td>王小明</td>
                      <td>0912345678</td>
                    </tr>
                  </tbody>
                </table>
              </div>  
            </div>
          </div>
        </div>
        @stop
      ```

  + 建立 Controllers
    + 例 :
      ```bash
      # php artisan make:controller CustomerController
      ```
    + 修改 app/Http/Controllers/CustomerController.php
      ```php
      <?php
      namespace App\Http\Controllers;
      
      use Illuminate\Http\Request;
      use Route;
      use View;
      class CustomerController extends Controller
      {
        public function index(){
                return View::make('board');
        }
      }
      ```
    
  + 建立路由
    + 例 : 修改 routes/web.php
      ```php
      Route::resource('customer','CustomerController');
      ```

#### 參考文獻
+ [Controller 控制器](https://dometi.com.tw/blog/laravel-beginner-12/)
+ [Laravel 6 以使用者帳號名稱或 Email 信箱登入教學](https://officeguide.cc/laravel-6-how-to-let-user-login-with-email-or-username/)
+ [HTTP 控制器](https://laravel.tw/docs/5.2/controllers)
+ [Views, Blade Templates](https://dometi.com.tw/blog/laravel-beginner-06/)
+ [HighLight的實作](https://dometi.com.tw/blog/laravel-beginner-08/)