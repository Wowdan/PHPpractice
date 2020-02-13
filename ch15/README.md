### 第十五章 使用中介層
#### Laravel 的中介層
+ 中介層概述
  + MiddleWare : HTTP 的中介層
  + 作用
    + 用來過濾任何進入應用程式的 HTTP 請求
    + 利於請求在進入路由之前對路由進行保護
    + 可對請求或回傳進行相關的操作
  + 分類
    + 全域中介層 : 對整個應用程式均有作用，利用 $middleware 屬性進行設定
    + 路由中介層 : 只針對特定的應用程式，利用 $routeMiddleware 屬性進行設定
      + 路由中介層群組 : 可一次作用多個中介層，所有路由皆會套用 web 的路由中介層群組！
        + web : routes/web.php 檔案內，可針對 cookie、session、CSRF 保護，提供實用的中介層！
        + api : routes/api.php 檔案內，提供上述項目以外的中介層！
+ 建立中介層
  + 使用 artisan
    ```bash
    #php artisan make:middleware [中介層名稱]
    ```
  + 相關目錄 : app/Http/Middleware
  + 處理請求(Request)的中介層程式內容
    ```php
    class [中介層名稱] {
        public function handle($request, Closure $next){
            //執行過濾請求的動作
            //請求通過後
            return $next($request);
        }
    }
    ```
  + 處理回傳(Response)的中介層程式內容
    ```php
    class [中介層名稱] {
        public function handle($request, Closure $next){
            $response = $next($request);
            //執行離開應用程式時的動作
            //執行完後
            return $response;
        }
    } 
    ```
+ 註冊中介層
  + 在 app/Http/kernel.php 檔案內，加上自製的中介層即可！

#### Laravel 內建 Auth 機制
+ 建立 Laravel 內建的 Auth 機制
  + 使用 artisan 建立
    ```bash
    # composer require laravel/ui
    # php artisan ui vue --auth
    # npm install && npm run dev
    ```
+ 註冊路由
  + 在 routes/web.php 檔案中，將出現下列兩行 :
    ```php
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    ```
  + 所有 /home 路徑的網址，將會路由到 HomeController 的 index 方法！
  + 查詢所有經由 Auth 註冊的路由
    ```bash
    # php artisan route:list
    ```
+ 資料庫內容
  + Migration 路徑 : database/migrations
    + create_users_table : 建立 users 資料表
      ```php
      Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
      ```
    + create_password_resets_table : 儲存 user 重設密碼的權杖(token)資料表
      ```php
      Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
      ```

  + Eloquent 模組
    + app/User.php
      ```php
      <?php
      namespace App;

      use Illuminate\Contracts\Auth\MustVerifyEmail;
      use Illuminate\Foundation\Auth\User as Authenticatable;
      use Illuminate\Notifications\Notifiable;
      
      class User extends Authenticatable {
        use Notifiable;
        /**
        * The attributes that are mass assignable.
        * 可大量寫入資料的欄位
        * @var array
        */
        protected $fillable = [
          'name', 'email', 'password',
        ];
        /**
        * The attributes that should be hidden for arrays.
        * 會被隱藏的欄位
        * @var array
        */
        protected $hidden = [
          'password', 'remember_token',
        ];
        /**
        * The attributes that should be cast to native types.
        * 保留原始資料型態的欄位
        * @var array
        */
        protected $casts = [
          'email_verified_at' => 'datetime',
        ];
      }
      ```

  + 取得登入資料
    + 可使用 auth() 函數，也可以使用靜態 Auth 介面！
    + 檢查用戶是否有登入，有登入會回傳 true
      ```php
      auth()->check();
      ```
    + 檢查用戶是否有登入，沒登入會回傳 true
      ```php
      auth()->guest();
      ```
    + 取得使用者登入資料
      ```php
      auth()->user();
      //或是使用 user id 來取得
      auth()->id();
      ```

+ Auth 控制器
  + 路徑 : app/Http/Contorllers/Auth
  + RegisterController : 負責註冊使用者的工作
    + 顯示註冊表單給用戶
    + 如何驗證註冊資料
    + 建立帳號
    + 建立帳號後，轉址至指定網頁
    ```php
    <?php
    namespace App\Http\Controllers\Auth;
    use App\Http\Controllers\Controller;
    use App\Providers\RouteServiceProvider;
    use App\User;
    use Illuminate\Foundation\Auth\RegistersUsers;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    class RegisterController extends Controller {
      use RegistersUsers;
    /**
      * Where to redirect users after registration.
      * 註冊後的轉址網頁
      * @var string
      */
      protected $redirectTo = RouteServiceProvider::HOME;

      /**
      * Create a new controller instance.
      * 經登入的使用者，無法使用該實例
      * @return void
      */
      public function __construct()
      {
          $this->middleware('guest');
      }
      /**
      * Get a validator for an incoming registration request.
      * 如何驗證註冊
      * @param  array  $data
      * @return \Illuminate\Contracts\Validation\Validator
      */
      protected function validator(array $data)
      {
          return Validator::make($data, [
              'name' => ['required', 'string', 'max:255'],
              'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
              'password' => ['required', 'string', 'min:8', 'confirmed'],
          ]);
      }

      /**
      * Create a new user instance after a valid registration.
      * 建立使用者
      * @param  array  $data
      * @return \App\User
      */
      protected function create(array $data)
      {
          return User::create([
              'name' => $data['name'],
              'email' => $data['email'],
              'password' => Hash::make($data['password']),
          ]);
      }
    }
    ```
  + LoginController : 負責讓使用者登入
    ```php
    <?php
    namespace App\Http\Controllers\Auth;
    use App\Http\Controllers\Controller;
    use App\Providers\RouteServiceProvider;
    use Illuminate\Foundation\Auth\AuthenticatesUsers;
    class LoginController extends Controller {
      use AuthenticatesUsers;

      /**
      * Where to redirect users after login.
      * 登入後，導向何處
      * @var string
      */
      protected $redirectTo = RouteServiceProvider::HOME;

      /**
      * Create a new controller instance.
      *使用 guest 中介層，登出時，則是使用 logout
      * @return void
      */
      public function __construct()
      {
          $this->middleware('guest')->except('logout');
      }
    }
    ```
    + LoginController 的路由表內容 :
      |HTTP Verb|路由|Controller|
      |:---|:---|:---|
      |GET|login|Auth\LoginController@showLoginForm|
      |POST|login|Auth\LoginController@login|
      |POST|logout|Auth\loginController@logout|

  + HomeController : 登入的使用者才可以存取
    ```php
    <?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    class HomeController extends Controller 
    {
      /**
      * Create a new controller instance.
      * 只要是指到 home 這個網址，會被帶到 auth 這個中介層，進行身份驗證
      * @return void
      */
      public function __construct()
      {
          $this->middleware('auth');
      }

      /**
      * Show the application dashboard.
      *
      * @return \Illuminate\Contracts\Support\Renderable
      */
      public function index()
      {
          return view('home');
      }
    }
    ```
  + ForgotPasswordController : 處理使用者忘記密碼
    + 送出 Email 進行密碼的修改
    ```php
    <?php
    namespace App\Http\Controllers\Auth;
    use App\Http\Controllers\Controller;
    use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
    class ForgotPasswordController extends Controller 
    {
      use SendsPasswordResetEmails;
      //以下自行加入
      //沒登入的使用者，才可以進行密碼忘記的處理
      public function __construct(){
        $this->middleware('guest');
      }
    }
    ```
    + ForgotPasswordController 路由表內容
      |HTTP Verb|路由|Controller|
      |:---|:---|:---|
      |POST|Password/email|Auth\ForgotPasswordController@sendResetLinkEmail|
      |GET|Password/reset|Auth\ForgotPasswordController@showLinkRequestForm|

  + ResetPasswordController : 負責處理忘記密碼驗證信的控制器
    ```php
    <?php
    namespace App\Http\Controllers\Auth;
    use App\Http\Controllers\Controller;
    use App\Providers\RouteServiceProvider;
    use Illuminate\Foundation\Auth\ResetsPasswords;
    class ResetPasswordController extends Controller
    {
      use ResetsPasswords;

      /**
      * Where to redirect users after resetting their password.
      * 引導使用者在修改好密碼時，導到相關的網址
      * @var string
      */
      protected $redirectTo = RouteServiceProvider::HOME;

      //以下自行加入
      //沒登入的使用者，才可以進行密碼忘記的處理
      public function __construct(){
        $this->middleware('guest');
      }
    }
    ```
    + ResetPasswordController 的路由表內容 :
      |HTTP Verb|路由|Controller|
      |:---|:---|:---|
      |POST|Password/reset|Auth\ResetPasswordController@reset|
      |GET|Password/reset/{token}|Auth\ResetPasswordController@showResetForm|

  + ConfirmPasswordController : 驗證密碼
    ```php
    <?php
    namespace App\Http\Controllers\Auth;
    use App\Http\Controllers\Controller;
    use App\Providers\RouteServiceProvider;
    use Illuminate\Foundation\Auth\ConfirmsPasswords;
    class ConfirmPasswordController extends Controller
    {
      use ConfirmsPasswords;

      /**
      * Where to redirect users when the intended url fails.
      * 驗證或網址有誤，重導回指定的頁面
      * @var string
      */
      protected $redirectTo = RouteServiceProvider::HOME;

      /**
      * Create a new controller instance.
      * 進行身份驗證工作
      * @return void
      */
      public function __construct()
      {
          $this->middleware('auth');
      }
    }
    ```
  + VerificationController :  驗證 Email ，送出驗證碼到使用者的 Email 信箱
    ```php
    <?php
    namespace App\Http\Controllers\Auth;
    use App\Http\Controllers\Controller;
    use App\Providers\RouteServiceProvider;
    use Illuminate\Foundation\Auth\VerifiesEmails;
    class VerificationController extends Controller
    {
      use VerifiesEmails;

      /**
      * Where to redirect users after verification.
      * 驗證完成後，重導使用者到指定的網址
      * @var string
      */
      protected $redirectTo = RouteServiceProvider::HOME;

      /**
      * Create a new controller instance.
      * 進行驗證、或是重送的動作
      * @return void
      */
      public function __construct()
      {
          $this->middleware('auth');
          $this->middleware('signed')->only('verify');
          $this->middleware('throttle:6,1')->only('verify', 'resend');
      }
    }
    ```

+ View 的使用
  + Auth 框架所新增/異動的檔案
    |檔案名稱|功能說明|
    |:---|:---|
    |welcome.blade.php|增加登入與註冊項目|
    |home.blade.php|登入後的首頁|
    |auth/login.bladephp|登入頁面|
    |auth/register.blade.php|註冊頁面|
    |auth/erify.blade.php|送出驗證碼至 email |
    |auth/passwords/email.blade.php|忘記密碼時，重送驗證碼至 email |
    |auth/passwords/reset.blade.php|忘記密碼時，重設密碼|
    |auth/passwords/confirm.blade.php|確認密碼|
  + 主樣板 layouts/app.blade.php 包含下列項目 :
    + head 標籤
    + nav 標籤
    + body 標籤

#### 自建 Auth 認證登入
+ 註冊路由
  + 編寫 routes/web.php 檔案內容 :
    ```php
    //加入下列幾行
    Route::group(['middleware' => 'auth'], function(){
      Route::get('edit', 'CustomerController@edit');
      Route::post('edit', 'CustomerController@update');
    });

    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', 'AuthController@getLogout');
    ```

+ 編寫控制器
  + 使用 artisan 新增 CustomerController
    + 編寫 app/Http/Controllers/CustomerController.php
      ```php
      use Auth;
      //其它部份略過
      public function edit(){
        return View::make('edit');
      }

      public function update(EditRequest $request){
        $user = Auth::user();
        $user->Name=$request->Name;
        $user->customer->Phone=$request->Phone;
        $user->customer->save();
        $user->save();

        return View::make('edit', [
          'msg' => '修改成功'
        ]);
      }
      ```

  + 使用 artisan 新增 AuthController 控制器
    + 編寫 app/Http/Controllers/AuthController.php
      ```php
      <?php
      namespace App\Http\Controllers;
      use Illuminate\Http\Request;
      use App\Http\Requests\LoginRequest;
      use Auth;
      use Redirect;
      use View;

      class AuthController extends Controller{
        public function __construct(){
          $this->middleware('guest',['except'=>['getLogout']]);
        }

        public function getLogin(){
          return View::make('login');
        }

        public function postLogin(LoginRequest $request){
          $authData = $request->only([
            'email','password'
          ]);

          if (Auth::attempt($authData, $request->has('remember'))){
            return Redirect::action('BoardController@getIndex');
          }else{
            return Redirect::back()->withError(['msg'=> '帳號或密碼輸入錯誤'])->withInput($request->except('password'));
          }
        }
        public function getLogout(){
          Auth::logout();
          return Redirect::action('BoardController@getIndex');
        }
      }
      ```
    + 編寫 app\Http\Requests\LoginRequest.php
      ```php
      <?php
      namespace App\Http\Requests;
      use Illuminate\Foundation\Http\FormRequest;
      
      class LoginRequest extends FormRequest{
        public function authorize(){
          return true;
        }
        public function rules(){
          return [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
          ];
        }
      }
      ```

+ 修改 View 內容
  + 修改 edit.blade.php
    ```php
    //前面略過
    <form action="{{ action('CustomerController@update') }}" method="POST">
      {{ csrf_filed() }}
    //後面略過
    ```
  + 修改 nav.blade.php
    ```php
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
          @auth
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown">
                {{ Auth::user()->Name }}, 您好
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-itme" href="{{ action('CustomerController@edit') }}">編輯</a>
                <a class="dropdown-item" href="{{ action('AuthController@getLogout') }}">登出</a>
              </div>
            </li>
          @else
            <li class="nav-item active">
              <a href="{{ action('AuthController@getLogin') }}" class="nav-link">登入</a>
            </li>
          @endauth
        </ul>
      </div>
    </nav>
    ```
  + 編寫 login.blade.php
    ```php
    @extends('layouts.master')

    @section('title', '登入')

    @section('content')
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">登入</div>
            <div class="card-body">
              <form method="POST" action="{{ action('AuthController@postLogin') }}">
                @csrf
                  <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label text-md-right">電子信箱</label>
                    <div class="col-md-6">
                      <input id="email" type="email" class="form-control{{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                      @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group" row>
                    <label for="password" class="col-md-4 col-form-label text-md-right">密碼</label>
                    <div class="col-md-6">
                      <input id="password" type="password" class="form-control{{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required>
                      @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                          <label class="form-check-lable" for="remember">記住我</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                      <button type="submit" class="btn btn-primary">登入</button>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    @stop
    ```
  + 
#### 參考文獻