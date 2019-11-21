### 第五章 HTML 與 CSS 基本語法
#### HTML5 基本語法
+ 概要
  + HTML (Hyper Text Markup Language, 超文本標記語言)由 W3C定義與維護的標準網頁語言。
+ HTML語法:
  + 標籤:
    + 帶有特殊含義的網頁的標記元素
    + 格式：\<開始標籤\> 標籤體 \</結束標籤\>
  + 分類:
    + 帶標籤體的標籤 如： **\<p\>** XX **\</p\>**
    + 不帶標籤體的標籤 如： **\<br/\>**
    + 標籤應該成對出現
  + 屬性
    + 寫在開始標籤上的 「key = value」 為該標籤屬性值，例：
      ```html
       <font color="red">標籤體</font>
      ```
      + color 即為該標籤的屬性值！
    + 一個標籤可以有多個屬性，多個屬性之間使用空格隔開。
  + 注釋
    ```html
    <!--我是注釋-->
    ```
  + <font color="red">注意</font>：根據 HTML5的標準，HTML5文件可以略過 \<html\>、\<head\>、\<body\> 等標籤！
+ HTML主要結構:
    ```html
    <!DOCTYPE html>
    <html>
        <head></head>
        <body></body>
    </html>
    ```
  + 起頭命令句，告訴瀏覽器這個檔案是一個 html5 檔。
    ```html
    <!DOCTYPE html>
    ```
  + html基本結構:
    + html : 是不區分大小寫
    + 由 **\<html\>** 開始，由 **\</html\>** 結束，在這之間是分 **\<head\>** 和 **\<body\>** 兩部分!
      + **\<head\>** : 給 html 頁面增加一些輔助或者屬性值，裡面的內容會最先載入。
      + **\<body\>** : 標籤裡面存放的才是真正要顯示的數據
    + 在開頭 <html> 可以加入語言判定的標籤，例如:
       ```html
       <html lang="en-US">
       ```
  + Head 部分：用於表示網頁的基本資訊
    + 常用標籤與屬性：
      1. title ：瀏覽器標籤頁顯示的標題
      2. meta ：其常用屬性如下
         1. charset : 設置文檔的字符集編碼格式。
         2. http-equiv : 將資訊寫給瀏覽器看，要求瀏覽器執行，可選屬性值
            1. Content-Type：文件類型
            2. refresh：網頁定時刷新
            3. set-cookie：設置瀏覽器cookie，需要配合content屬性使用。http-equiv屬性只是表明需要設置哪一部分，具體的設置內容，放到content屬性中
            4. name：使用方法如同「http-equiv」。將資訊寫給搜尋引擎看！常用且需要掌握的屬性值：
               1. author：作者
               2. keywords：網頁關鍵字
               3. description：網頁描述
         3. 例：
            ```html
            <meta charset="UTF-8">
            <meta name="description" content="網頁簡短描述">
            <meta name="keywords" content="網頁關鍵字">
            <meta http-equiv="refresh" content="30">
            <meta name="author" content="John Doe">
            ```
      3. link：連結資訊，其常用屬性有：
         1. rel ：通知瀏覽器相關資訊
         2. type ：可以是文字類型，或是其它類型
         3. href ：表示連結路徑地址
         4. 例：
            ```html
            <link rel="stylesheet" type="text/css" href="main.css"/>
            ```
      4.  style: 定義該網頁的樣式格式
        + 例：
          ```html
          <style>
            body {background-color: powderblue;}
            h1 {color: red;}
            p {color: blue;}
            </style>
          ```
      5.  script：用來定義給客戶端執的 JavaScripts 檔案
        + 例：
          ```html
          <script>
            function myFunction {
            document.getElementById("demo").innerHTML = "Hello JavaScript!";
            }
          </script>
          ```
      6.  base: 指定該網頁上基本網頁的 url 位置
        + 例：
          ```html
          <base href="https://www.w3schools.com/images/" target="_blank">
          ```
  + Body 部份：網頁真正會展示給使用者看的內容
    + 標題 : 有六種大小，從 \<h1\> ～ \<h6\>，預設字體大小為24pt ～ 8pt
      + 例 :
        ```html
        <h1>I'm headline 1</h1>
        <h2>I'm headline 2</h2>
        <h3>I'm headline 3</h3>
        <h4>I'm headline 4</h4>
        <h5>I'm headline 5</h5>
        <h6>I'm headline 6</h6>
        ```
    + 段落 : \<p\>\</p\>
      + 例 :
        ```html
        <p>This is a paragraph.</p>
        <p>This is another paragraph.</p>
        ```
    + 超連結 : \<a\>\</a\>
      + 例 :
        ```html
        <a href="https://www.google.com">google</a>
        ```
      + href : 指定目的地網址名稱
    + 圖片連結設定：\<img\>\</img\>
      + 例 :
        ```html
        <img src="img/test1.jpg" alt="Hello World" width="104" height="142">美女圖</img>
        ```
      + src : 指定圖檔路徑
      + alt : 圖檔說明文字
      + width : 圖檔顯示的寬度
      + height : 圖檔顯示的高度
    + 按鍵 : \<button\>\</button\>
      + 例 :
        ```html
        <button>Click me</button>
        ```
    + 列表清單 :
      + 有序清單 : \<ol\>\</ol\>
      + 無序清單 : \<ul\>\</ul\>
      + 列表項目 : \<li\>\</li\>
      + 例：
        ```html
        <ul>
          <li>Coffee</li>
          <li>Tea</li>
          <li>Milk</li>
        </ul>

        <ol>
          <li>Coffee</li>
          <li>Tea</li>
          <li>Milk</li>
        </ol>
        ```

+ HTML5 新增項目
  + HTML5　新增元素列表 :
  
  |Tag|Description|
  |:---:|:---|
  |\<article\>|	Defines an article in a document|
  |\<aside\>|	Defines content aside from the page content|
  |\<bdi\>|	Isolates a part of text that might be formatted in a different direction from other text outside it|
  |\<details\>|	Defines additional details that the user can view or hide|
  |\<dialog\>|	Defines a dialog box or window|
  |\<figcaption\>|	Defines a caption for a \<figure\> element|
  |\<figure\>|	Defines self-contained content|
  |\<footer\>|	Defines a footer for a document or section|
  |\<header\>|	Defines a header for a document or section|
  |\<main\>|	Defines the main content of a document|
  |\<mark\>|	Defines marked/highlighted text|
  |\<meter\>|	Defines a scalar measurement within a known range (a gauge)|
  |\<nav\>|	Defines navigation links|
  |\<progress\>|	Represents the progress of a task|
  |\<rp\>|	Defines what to show in browsers that do |not support ruby annotations
  |\<rt\>|	Defines an explanation/pronunciation of characters (for East Asian typography)|
  |\<ruby\>|	Defines a ruby annotation (for East Asian typography)|
  |\<section\>|	Defines a section in a document|
  |\<summary\>|	Defines a visible heading for a \<details\> element|
  |\<time\>|	Defines a date/time|
  |\<wbr\>|	Defines a possible line-break|

  + HTML5 表格新增元素 :

  |Tag|Description|
  |:---:|:---|
  |\<datalist\>|	Specifies a list of pre-defined options for input controls|
  |\<output\>|	Defines the result of a calculation|

  + HTML5 新增可辨視輸入類型的種類 :
    + 輸入類型分類：
      + color
      + date
      + datetime
      + datetime-local
      + email
      + month
      + number
      + range
      + search
      + tel
      + time
      + url
      + week
    + 輸入類型屬性 :
      + autocomplete
      + autofocus
      + form
      + formaction
      + formenctype
      + formmethod
      + formnovalidate
      + formtarget
      + height and width
      + list
      + min and max
      + multiple
      + pattern (regexp)
      + placeholder
      + required
      + step
  
  + HTML5 新增繪圖標籤
    
    |Tag|Description|
    |:---:|:---|
    |\<canvas\>|	Draw graphics, on the fly, via scripting (usually JavaScript)|
    |\<svg\>|	Draw scalable vector graphics|

  + HTML5 新增多媒體標籤
    
    |Tag|Description|
    |:---:|:---|
    |\<audio\>|	Defines sound content|
    |\<embed\>|	Defines a container for an external (non-HTML) application|
    |\<source\>| Defines multiple media resources for media elements (\<video\> and \<audio\>)|
    |\<track\>|	Defines text tracks for media elements (\<video\> and \<audio\>)|
    |\<video\>| Defines video or movie|

#### CSS3 基本語法
+ CSS 概述
  + 層疊樣式表（Cascading Style Sheets, CSS）是用來描述HTML 或XML（包含SVG 或XHTML 等各種XML 變形）文件外觀的樣式表語言。
  + CSS 可以讓多個 Web 網頁套用同一個層級樣式，節省許多排版工時！
  + 許多額外的樣式可存放於 CSS 檔案中！

+ CSS 語法格式定義
  + CSS 語法格式中，分成選擇器與宣告兩部份 :
    ![CSS 語法組成格式圖](img/1.gif)
    + Selector : 通常是 HTML 標籤名稱，可加上屬性名稱，做更仔細的設定！
    + Declaration : 定義屬性值，做外觀的變化設定！
      + 每個宣告設定語法結尾，使用分號做結尾！　
    + 例 : 定義段落標籤\<p\>文字顏色以及位置置中！
      ```html
      p {
        color: red;
        text-align: center;
      }
      ```
  + CSS 的註解
    + 多數用來說明語法，瀏覽器在解析語法時會略過
    + 例 :
      ```html
      p {
          color: red;
          /* This is a single-line comment */
          text-align: center;
        }

        /* This is
        a multi-line
        comment */
      ```

+ HTML 如何加入 CSS
  + 共有三種方式，可在 HTML 中插入 CSS 
    + 加入外部 CSS 檔案
      + 在 \<head\> 標籤區塊內，加入\<link\>標籤屬性，宣告使用的檔案位置！
      + 可多個網頁共用一個 CSS 檔案！
      + 例：
        ```html
        <!DOCTYPE html>
        <html>
        <head>
        <link rel="stylesheet" type="text/css" href="mystyle.css">
        </head>
        <body>

        <h1>This is a heading</h1>
        <p>This is a paragraph.</p>

        </body>
        </html>
        ```
        + mystyle.css 檔案內容 : 
          ```html
          body {
            background-color: lightblue;
          }

          h1 {
            color: navy;
            margin-left: 20px;
          }
          ```
    + HTML 內部設定 CSS 語法
      + 針對單一網頁內容進行設定
      + 在 \<head\> 標籤區塊內，將 CSS 設定語法寫入 \<style\> 區塊內！
      + 例 :
        ```html
        <!DOCTYPE html>
        <html>
        <head>
        <style>
        body {
          background-color: linen;
        }

        h1 {
          color: maroon;
          margin-left: 40px;
        }
        </style>
        </head>
        <body>

        <h1>This is a heading</h1>
        <p>This is a paragraph.</p>

        </body>
        </html>
        ``` 
    + 內嵌至 HTML 語法標籤內
      + 針對單一標籤進行外觀設定
      + 例 :
        ```html
        <!DOCTYPE html>
        <html>
        <body>

        <h1 style="color:blue;text-align:center;">This is a heading</h1>
        <p style="color:red;">This is a paragraph.</p>

        </body>
        </html>
        ``` 
  + CSS 的串列順序
    + CSS 執行順序，從最高到最低 :
      1. 內嵌至 HTML 語法標籤內的 CSS 樣式
      2. HTML 內部設定的 CSS 語法
      3. 外部加入的 CSS 檔案
    + PS: 第 2 點與第 3 點的設定順序，在後的設定會覆寫之前的設定，例：
      ```html
      <head>
      <style>
      h1 {
        color: orange;
      }
      </style>
      <link rel="stylesheet" type="text/css" href="mystyle.css">
      </head>
      ```
      ----------------------
      ```html
      mystyle.css 檔案內容：
      h1 {
        color: navy;
      }
      ```
      + 後來的 \<h1\> 標籤，文字顏色將是 "orange" !!
+ CSS 的 Selector 類型 :
  + 基於標籤名稱的 Selector ，例如 \<p\> :
    ```html
    p {
      text-align: center;
      color: red;
    }
    ```
  + 基於 HTML 標籤內元素名稱 id 屬性值的 Selector , 例如 \<h1 id="para1"\> :
    ```html
    #para1 {
      text-align: center;
      color: red;
    }
    ```
    + HTML 標籤的 id 值，都是唯一值！
  + 基於 HTML 標籤內元素名稱 class 屬性值的 Selector , 例如 \<p class="center"\> : 
    ```html
    .center {
      text-align: center;
      color: red;
    }
    ```
    + 不同標籤值，可以使用相同的類別屬性！
  + 同時指定標籤名稱與元素 id 值的 Selector , 例如 \<p id="center"\> :
    ```html
    p.center {
      text-align: center;
      color: red;
    }
    ```
  + 同時指定標籤名稱與多個元素 id 值的 Selector，例如 \<p id="center large"\> :
    ```html
    p.center {
      text-align: center;
      color: red;
    }

    p.large {
      font-size: 300%;
    }
    ``` 
  + 通用 Selector :
    + 表示所有標籤均使用的 Selector !
      ```html
      * {
        text-align: center;
        color: blue;
      }
      ```
  + 群組標籤 Selector :
    + 將某些標籤一起定義格式的作法　！
      ```html
      h1 {
        text-align: center;
        color: red;
      }

      h2 {
        text-align: center;
        color: red;
      }

      p {
        text-align: center;
        color: red;
      }
      ```
      可以改成如下做法：
      ```html
      h1, h2, p {
        text-align: center;
        color: red;
      }
      ```

#### Bootstrap 4 框架基本語法
+ Bootstrap 概要
  + 一種免費的前端網頁框架
  + 框架內包含了HTML 與 CSS 的設計樣版
  + 利用 Bootstrap 可以快速開發行動版網頁
  + 目前己發表到第４版本

+ 開始使用 Bootstrap 的方式(下列兩種擇一即可開始使用)
  + 引入 Bootstrap 官方的 CDN (Content Delivery Network) 連結
    + 連結的網址如下 :
      ```html
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- jQuery library -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      ```
  + 下載 Bootstrap 軟體，放置到網頁目錄內
    + 下載[官網](https://github.com/twbs/bootstrap/releases/download/v4.3.1/bootstrap-4.3.1-dist.zip)
    + 下載後，放置網頁目錄錄徑！
  + 例 : hello.html
    ```html
      <!doctype html>
      <html lang="en">
        <head>
          <!-- Required meta tags -->
          <meta charset="utf-8">
          <!-- Responsive meta tag -->
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

          <!-- Bootstrap CSS -->
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

          <title>Hello, world!</title>
        </head>
        <body>
          <h1>Hello, world!</h1>

          <!-- Optional JavaScript -->
          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>
      </html>
    ```
+ Bootstrap 網格的概念
  + Bootstrap 將一整個網頁寬度，使用最多的 12 個網格！
    + 如果不想要使用到 12 個網格，可以將網格合併！
    + 例 :
      ![12網格](img/2.png)
    + 網格將會依據螢幕大小，按比例縮放！
  + Bootstrap 網格系統的類型共有五種 :
    + .col- (最小的平台，螢幕寬度低於 576px)
    + .col-sm- (小型平台，螢幕寬度大於等於 576px)
    + .col-md- (中型平台，螢幕寬度大於等於 768px)
    + .col-lg- (大型平台，螢幕寬度大於等於 992px)
    + .col-xl- (超大型平台，螢幕寬度大於等於 1200px)
    + PS : 螢幕寬度低於設定的 px 值，將會互相自動堆疊
  + 例 : 
    ```html
    <!-- 第一個「*」號代表任一類型 -->
    <!-- 第二個「*」號代表均分網格 -->
    <div class="row">
      <div class="col-*-*"></div>
      <div class="col-*-*"></div>
    </div>
    <div class="row">
      <div class="col-*-*"></div>
      <div class="col-*-*"></div>
      <div class="col-*-*"></div>
    </div>
    <!-- 讓 Bootstrap 自動處理佈局 -->
    <div class="row">
      <div class="col"></div>
      <div class="col"></div>
      <div class="col"></div>
    </div>
    ```
  + 可以設定不等分的網格 :
  + 例：
    ```html
    <div class="row">
      <div class="col-sm-4">.col-sm-4</div>
      <div class="col-sm-8">.col-sm-8</div>
    </div>
    ```

#### VS Code Extensions 安裝提示
+ 由 Extensions 安裝 VS Code 外掛軟體
  + [工具列] -> [View] -> [Extensions]
  + [左方工具列] -> [Extensions] 圖示（看起來有四個方塊的圖案）
+ HTML ＆ CSS 推薦外掛套件
  + HTML Snippets
  + HTML CSS Support
  + IntelliSense for CSS class names in HTML
  + JS-CSS-HTML Formatter

#### 參考文獻
+ [W3 School](https://www.w3schools.com/)
+ [Bootstrap 4繁體中文手冊](https://bootstrap.hexschool.com/docs/4.2/getting-started/introduction/)
