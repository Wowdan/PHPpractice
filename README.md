<<<<<<< HEAD
# PHP 後端網路工程師養成班
## 課程大綱
### 第零章 課前說明 [內容](ch0/README.md)
#### 課程教材使用方式
+ 申請 Github 帳號
+ 課堂下載檔案
#### 專案製作
+ 專案構思與製作
+ 程式碼放置於 GitHub 站台
#### 證照考試
+ 國內證照考試
  + TQC MySQL
+ 國外證照考試
  + Zend PHP
  + Oracle MySQL  
#### 課程後該學會的事
+ 了解網站應用系統架構
+ 開發環境與正式環境需求
+ 版控需求與應用
+ 佈署流程的認知
  
### 第一章 環境建置 [內容](ch1/README.md)
#### 正式環境建置
+ 安裝與使用虚擬機軟體
  + 下載 VirtualBox，官網：https://www.virtualbox.org 
  + 安裝 VirtualBox
  + 新增虚擬機與調整設定
+ 安裝與設定 Linux 作業系統
  + 安裝 CentOS 8 Linux 作業系統
  + 設定網路組態與遠端控制
#### 開發環境建置
+ 安裝開發工具 VSCode 
  + 官網: https://code.visualstudio.com/docs/?dv=win
  + VSCode 基本操作與使用
#### 參考文獻

### 第二章 Linux 作業系統基本操作 [內容](ch2/README.md)
#### 檔案與目錄管理
+ Linux 檔案與目錄架構
+ 檔案與目錄管理指令
#### 使用者與群組管理
+ 使用者與群組概念
+ 使用者與群組管理指令
#### 基本權限管理
+ Linux 權限概念
+ 權限管理指令
#### 軟體安裝與管理
+ Linux 軟體安裝概念
+ YUM 軟體安裝與管理
#### Web 站台架設
+ Nginx 套件安裝與啟用
+ PHP 套件安裝與啟用
#### 基本安全設定
+ 基本防火牆應用
+ SELinux 的基本應用
#### 參考文獻

### 第三章 MySQL 操作與 SQL 語法 [內容](ch3/README.md)
#### 安裝 MySQL
+ Linux 平台安裝 MySQL Server
+ Linux 平台安裝 phpMyAdmin 管理程式
+ Windows 平台安裝 MySQL Workbench
#### 資料收集與整理
+ 資料收集與整理
+ 資料表正規化
#### MySQL 基本操作
+ SQL 語法認知
+ 資料庫內可接受的資料類型
+ 操作資料庫與資料表
+ 操作資料內容
+ 操作資料庫系統
#### 參考文獻

### 第四章 Git 版控與 GitHub 的應用 [內容](ch4/README.md)
#### 版控的觀念與使用
+ 關於版本控制
+ 本地端版本控制
+ 集中式版本控制系統
+ 分散式版本控制系統
+ Git 基礎要點
#### 使用 Git 指令
+ 初次設定 Git
+ 取得一個 Git 倉儲
+ 紀錄變更到版本庫中
#### 使用 GitHub 站台儲放程式碼
+ 與遠端協同工作
+ 顯示遠端
+ 新增遠端版本庫
+ 從遠端獲取或拉取
+ 推送到遠端
+ 檢視遠端
+ 移除或重新命名遠端
#### 使用 MarkDown 語法
+ 概述
+ 區塊元素
+ 區段元素
#### 參考文獻

### 第五章 HTML 與 CSS 基本語法 [內容](ch5/README.md)
#### HTML5 基本語法
+ 概要
+ HTML語法
+ HTML主要結構
+ HTML5 新增標籤
#### CSS3 基本語法
+ CSS 概述
+ CSS 語法格式定義
#### Bootstrap 4 框架基本語法
+ Bootstrap 概要
+ 開始使用 Bootstrap 的方式
+ Bootstrap 網格的概念
#### VS Code Extensions 安裝提示
+ 由 Extensions 安裝 VS Code 外掛軟體
+ HTML ＆ CSS 推薦外掛套件
#### 參考文獻

### 第六章 PHP 基本語法 [內容](ch6/README.md)
#### PHP 基本觀念
+ 站台的運作方式
+ PHP 的運作方式
+ PHP 包含 HTML 標籤
#### 變數
+ 變數
+ 變數的存活範圍
+ 常數
#### 資料型態
+ 標準資料型態
+ 資料型態轉換
#### 運算子
+ 運算式與運算子
+ 運算子的優先順序
+ 太空船運算子
#### 陣列
+ 宣告方式
#### 控制結構
+ 決策控制
+ 迴圈控制
+ 巢狀迴圈
+ break 與 continue
#### 參考文獻

### 第七章 PHP 進階語法 I [內容](ch7/README.md)
#### 函數
+ 函數的作用
+ 使用方式
+ 可變長度引數
+ 遞迴函數
+ 參數與回傳值宣告
#### 物件導向
+ 物件導向的目的
+ 類別與物件 (Class & Object)
+ 封裝 (Encapsulation)
+ 建構子(constructor)與解建構子(destructor)
+ 繼承(extends)
+ 覆寫(override)
+ 介面(interface)
+ 抽象類別 (Abstract)
+ 靜態屬性(static)
+ 多型(Polymorphism)
+ 多載(overloading)
+ 匿名類別
#### 參考文獻

### 第八章 PHP 進階語法II [內容](ch8/README.md)
#### 類別的應用與處理
+ 自動載入
+ 命名空間(Namespace)
+ 特徵(Trait)
#### 例外處理
+ 掌握錯誤與例外
+ 錯誤的情況處理分類
+ 錯誤與例外的不同
+ 例外的情況處理分類
+ try...catch 敘述
+ 抛出例外與接收
+ Exception 類別的繼承
+ 多層次的例外處理
#### 參考文獻

### 第九章 套件、框架、Composer [內容](ch9/README.md)
#### 套件
+ PHP 套件庫
+ 自製套件
#### Composer
+ Composer 工具
+ Composer 運作方式
#### 框架
+ 框架思維
+ Laravel 框架特色
+ 安裝與設定 Laravel
+ Laravel 目錄結構
+ Artisan 工具
+ Laravel 運作流程
#### 參考文獻

### 第十章 Laravel 的ＭＶＣ I [內容](ch10/README.md)
#### HTTP 相關基本知識
+ HTTP 資料傳遞
+ HTTP 標頭與回應
#### MVC 概念
+ MVC (Model-View-Controller)概念
#### Laravel 的 Router 模組
+ Laravel Routing簡介
+ Laravel Routing 語法
+ 路由參數傳遞
+ 使用路由群組
+ 路由命名
+ 路由表的查詢
#### 參考文獻

### 第十一章 Laravel 的ＭＶＣ II [內容](ch11/README.md)
#### Controller 的使用
+ Controller 的用途
+ 建立 Controller
+ 由 Route 轉發要求給 Controller
+ 路由可以指定 Controller 處理七種不同要求
+ Controller 命名空間
#### View 與 Blade 的使用
+ Laravel 的網頁根目錄
+ Laravel 的 View 目錄
+ 基本使用 View 的方式
+ Blade 樣板引擎
+ Blade 語法
+ Blade 樣板實作
#### 參考文獻

### 第十二章 Laravel 與資料庫的結合 [內容](ch12/README.md)
#### 基本資料庫連線與操作
+ 連接資料庫的設定方式
+ 利用 MVC 連接資料庫
+ 其他的 SQL 語法使用方式
#### 使用 Migration 操作資料庫物件
+ Migration 用途
+ Migration 初始化
+ 建立 Migration
+ 操作 Migration 指令
+ Schema 類別
+ Blueprint 操作資料表方法
#### 使用 Eloguent 管理資料庫內容
+ Eloguent 概述
+ Eloguent 建立過程
+ Eloquent 中 Model 的常見屬性值列表
+ Eloquent 中常見的查詢類方法
+ Eloquent 資料取出的方法
+ Collection 物件的方法
+ 
#### 參考文獻

#### 參考書籍
#### 參考網站

+ [MarkDown 文件](https://markdown.tw/)
+ [GitFlow 觀念](https://medium.com/kuma%E8%80%81%E5%B8%AB%E7%9A%84%E8%BB%9F%E9%AB%94%E5%B7%A5%E7%A8%8B%E6%95%99%E5%AE%A4/%E5%9F%BA%E7%A4%8E-git-flow-%E5%B7%A5%E4%BD%9C%E6%B3%95-fa50b1dddc4f)
+ [什麼是 CI/CD](https://medium.com/@william456821/%E4%BB%80%E9%BA%BC%E6%98%AF-ci-cd-72bd5ae571f1)
+ [Git達人教你搞懂GitHub基礎觀念](https://www.ithome.com.tw/news/95283)
+ [git 教學文件](https://zlargon.gitbooks.io/git-tutorial/content/)
=======
<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)
- [Appoly](https://www.appoly.co.uk)
- [OP.GG](https://op.gg)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
"# PHPproject" 
>>>>>>> 9cfffa7a8680992b172e3377d1db434d312ed4da
