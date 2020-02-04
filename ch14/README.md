### 第十四章 請求、回傳、資料驗證
#### 請求與回應
+ 概述
  + Request 請求 : HTTP 定義的方法，也稱為 HTTP 動詞(HTTP verb.)!包含先前章節提過的 GET\POST\PUT\DELETE\PATCH 等方法！
  + 在 Laravel 的使用上，可透過依賴注入 (Dependency Injection) 來取得 HTTP 的請求資訊！
  + 只要在 Controller 傳入值的地方，傳入 Request 型別的資料，即可取得！ 

+ 請求的方法
  + 取得請求的路徑
    + 例 :
      ```php
      // Controller 內的設定
      public function update($Cusid, Request $request){ ... }

      //使用的方法
      $request->path();
      //取得的回傳值
      echo $request;  // 會出現 edit/(Cusid)

      //完整傳回網址路徑
      $request->url();
      ```
      
  + 取得輸入資料
    + 無須擔心發出請求時的 HTTP 動詞，取得的方法都相同！
    + 例 :
      ```php
      //取得 name 欄位的資料
      $request->input('name');
      //如果是HTML表單，而且有 name 欄位
      $request->name;
      //如果資料有第二個參數可供替代選擇
      $request->input('name','tel');
      //如果是陣列資料，只要透過「.」就可以存取
      $request->input('names.0.name');
      ```

  + 輸入值是否存在
    + 例 :
      ```php
      $request->has('name');
      ```

  + 取得所有輸入資料
    + 例 :
      ```php
      $request->all();
      ```

  + 取得部份輸入的資料
    + 例 :
      ```php
      //只取得 name 陣列資料
      $request->only(['name']);
      //只取得 name 欄位資料
      $request->only('name');
      //只不取 name 陣列資料
      $request->except(['name']);
      //只不取 name 欄位資料
      $request->except('name');
      ```

  + 將輸入的資料暫存至 Session
    + 例 :
      ```php
      $request->flash();
      //存取部份資料的方法
      $request->flashOnly('name');
      $request->flashExpect('name');
      ```
    + 
  + 將 Session 內的資料取出
    + 例 :
      ```php
      //重新導向回首頁，利用 request 取回資料
      return Redirect::action('BoardController@getIndex')->withInput($request->only('name'));
      ```

  + 取得 Session 舊輸入資料
    + 例 :
      ```php
      $request->old('name');
      //在 blade 中，則可以使用下列語法
      // {{ old('name') }}
      ```

  + 取得 Cookie 
    + Laravel 會對每個建立的 cookie 加密，並加上認證記號！
    + 從當次請求中取出 cookie 值，可使用下列方法 :
      ```php
      $request->cookie('name');
      ```

  + 將新的 cookie 加入到 Response 中
    + 例 :
      ```php
      return $response->withCookie(cookie('name','tel'));
      //可加入長期 cookie
      return $response->withCookie(cookie()->forever('name','tel'));
      ```

  + 取得上傳檔案
    + 使用 file 方法 :
      ```php
      $request->file('hello.txt');
      ```

  + 確認上傳檔案
    + 使用 hasFile 可判斷上傳的檔案是否存在
      ```php
      $request->hasFile('hello.txt');
      ```

  + 驗證上傳的檔案是否有效
    + 例 :
      ```php
      $request->file('hello.txt')->isValid();
      ```

  + 移動上傳的檔案
    + 例 :
      ```php
      $request->file('hello.txt')->move(目標路徑);
      ```

+ 回應的方法
  + 所有 Route 與 Controller ，都需回傳資料給瀏覽器！
    + 回傳一般字串
      ```php
      return 'Hello Wolrd';
      ```
    + 回傳 View
      ```php
      return view('welcome');
      return View::make('edit',['Cusid'=>$cusid]);
      ```
    + 回傳 JSON
      ```php
      return response()->json(['Name' => 'Peter','Phone' => '0912345678']);
      ```
    + 檔案下載
      ```php
      return response()->download([檔案路徑],[檔案自訂名稱],[HTTP標頭]);
      ```
    + Redirect 重導向
      ```php
      return Redirect::to('/');
      return Redirect::route('customer',['Cusid'=>$cusid]);
      return Redirect::action('CustomerController@getCustomerName','Name'=>$name,'Cusid'=>$cusid);
      ```

+ 方法欺騙
  + HTML 表單方法只有 GET 與 POST
  + 如果需要使用 HTTP 動詞中所有的方法，需要使用隱藏的 _methon 欄位
  + 例 :
    ```html
    <form action="{{ route('index') }}" method="POST">
      @csrf
      <input type="hidden" name="_method" value="PUT">
    </form>
    <!--也可以直接使用 blade 來生成-->
    <form action="{{ route('index') }}" method="POST">
      @csrf
      @method('PUT')
    </form>
    ```
#### 資料驗證
+ 資料驗證
  + 查驗資料是否有按照規定填寫
  + 語法 :
    ```php
    Validator::make([需要驗證的參數陣列],[欄位名稱]=>[規則A|規則B],[驗證欄位]=>[錯誤訊息自定義]);
    ```
  + 例 : CustomerController.php (請記得先新增該 Controller)
    ```php
    $validator = Validator::make(
      $request->all(),[
        'Name' => 'required|string',
        'Phone' => 'required|string'
      ],[
        'required' => '不可為空白',
        'required' => '須為字串'
      ]
    );
    // 判斷方式
    if ($validator->fail()){
      return redirect()->back()->withErrors($validator);
    } else {
      $customer = CustomerEloquent::where('Cusid',$cusid)->firstOrFail();
      $customer->Phone = $request->Phone;
      $customer->save();

      return View::make('edit',[
        'customer' => $customer,
        'msg' => '修改成功'
      ]);
    }
    ```
  + 規則清單
    |規則|說明|
    |:---:|:---|
    |boolean|布林值格式，例 : true,false,0,1,"0","1"|
    |email| Email 格式|
    |integer|整數格式|
    |numeric|數字格式，包含浮點數|
    |string|字串格式|
    |max:[value]|數字不可以大於此值，字串字數不可以大於此值|
    |min:[value]|數字不可以小於此值，字串字數不可以少於此值|
    |regex:[pattern]|應符合的正規化表示式|
    |required|必填欄位|
    |nullable|可為空值|
    |same:[field]|與指定欄位值必須相同|
    |unique:[table,column]|某表的某欄位中，此值必須是唯一值|
    
+ 表單驗證
  + 利用 artisaan 的 make:request 來快速建立一個 Form Request
    ```bash
    # php artisan make:request EditCustomer
    ```
  + 建立完成後，將驗證內容放進 Form Request:
    + 例 : app/Http/Requests/EditCustomer.php
      ```php
      <?php
      namespace App\Http\Requests;
      use Illuminate\Foundation\Http\FormRequest;
      class EditCustomer extends FormRequest
      {
        /**
         * 決定是否使用者被驗證用來使用該請求
         * Determine if the user is authorized to make this request.
         * 
         * @return bool
        */
        public function authorize()
        {
          //因為暫時未使用身份驗證機制，所以改成 true
          //return false;
          return false;    
        }
        /**
         * 取得驗證規則
         * Get the validation rules that apply to the request.
         * 
         * @return array
        */
        public function rules()
        {
          return [
            //填入要求的規則
            'Name' => 'required|string',
            'Phone' => 'required|string'
          ];
        }
        /** 自定義錯誤訊息
         * @return array
        */ 
        public function messages(){
          return [
            'required' => '不可為空白',
            'string' => '必須為字串'
          ];
        }
      }
      ```
  + 修改 Controller 中的 update 方法
    + 例 : app/Http/Controllers/CustomerController.php
      ```php
      //加入 EditCustomer
      use App\Http\Request\EditCustomer;
      // 中間一堆程式，先略過
      //編寫 update function
      public function update($Cusid, EditCustomer $request){
        //改寫後，就輕快多了！
        $customer = CustomerEloquent::where('Cusid', $Cusid)->firstOrFail();
        $customer->Phone = $request->Phone;
        $customer->save();

        return View::make('edit',[
          'customer' => $customer,
          'msg' => '修改成功'
        ]);
      } 
      ```

  + 修改一下路由設定
    + 例 : routes/web.php
      ```php
      Route::get('edit/{Cusid}','CustomerController@edit');
      Route::post('edit/{Cusid}', 'CustomerController@update');
      ```

  + 新增 edit 這個 View
    + 例 : resources/views/edit.blade.php
      ```html
      @extends('layouts.master')
      @section('content')
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="card">
            <div class="card-header">
              <h4 class="m-0">編輯客戶資料</h4>
            </div>
            <div class="card-body">
                @isset($msg)
                <div class="alert alert-success" role="alert">
                  {{ $msg ?? '沒有任何訊息' }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="CLose">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endisset

                <form action="{{ action('CustomerController@update', ['Cusid' => $Cusid]) }}" method="POST">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="name">客戶姓名</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ $customer->Name }}">
                       @if ($errors->has('name'))
                         <div class="invalid-feeback">
                          <strong>{{ $errors->first('name') }}</strong>
                         </div>
                       @endif
                  </div>
                  <div class="form-group">
                    <label for="phone">客戶電話</label>
                    <input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" name="phone" value="{{ $customer->Phone }}">
                       @if ($errors->has('phone'))
                         <div class="invalid-feeback">
                          <strong>{{ $errors->first('phone') }}</strong>
                         </div>
                       @endif
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-1">
                      <button type="submit" class="btn btn-primary btn-block">修改</button>
                    </div>
                    <div class="col-md-6">
                      <a href="{{ url('/board') }}" class="btn btn-danger btn-block">返回</a>
                    </div>
                  </div>
                </form>
              </div>  
            </div>
          </div>
        </div>
      @endsection
      ```

  + 修改 resources/views/board.blade.php
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
                  <th>系統操作</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>A001</td>
                  <td>王小明</td>
                  <td>0912345678</td>
                  <td>
                    <a href="{{ route('customers',['Cusid' => $Cusid -> customer -> Cusid]) }}" class="btn btn-info btn-sm">查看</a>
                    <a href="{{ action('SchoolController@edit', ['Cusid'=> $Cusid-> customer -> Cusid]) }}" class="btn btn-success btn-sm">編輯</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>  
        </div>
      </div>
    </div>
    @stop
    ``` 
#### 參考文獻