### 第一章 環境建置
#### 正式環境建置
+ 安裝與使用虚擬機軟體
  + 下載 [VirtualBox](https://www.virtualbox.org)
    + 官網：https://www.virtualbox.org 
  + 安裝 VirtualBox
  + 新增虚擬機與調整設定
    + 注意目錄設定
    + 注意網路設定
      + Bridge 橋接設定
      + NAT 網路轉址方式
      + 網路卡與內部網路設定
    + 注意 USB 設定
    + 虚擬機匯出與匯入
      + 方便回家練習
      + 備份與回復

+ 安裝與設定 Linux 作業系統
  + 安裝 [CentOS 8 Linux](https://www.centos.org/) 作業系統
    + 官網：https://www.centos.org/
  + 設定網路組態與遠端控制
    + 使用 nmtui 文字介面
    + 使用 「設定」-> 「網路」進行設定
    + 開啟 sshd 服務（預設開啟）
      + Windows 作業系統中，可使用 [putty](https://www.putty.org/) 進行連線
    + 開啟 xrdp 遠端桌面服務
    <pre><code>  #yum install epel-release
      #yum install xrdp
      #systemctl start xrdp
      #systemctl enable xrdp (指定開機時啟動服務)) 
      #firewall-cmd --add-service=xrdp --permanent
      #firewall-cmd --reload
    </code></pre>
  + 開啟 Web 操控介面
    <pre><code># systemctl enable --now cockpit.service  (啟動 Web 操控介面)
    # systemctl status cockpit.service -l  (檢查是否正常運作)
    </code></pre>
    + 開啟瀏覽器，輸入網址 http://IP位置:9090
    + 使用 root 帳號、密碼即可登入！

#### 開發環境建置
+ 安裝開發工具 [VSCode](https://code.visualstudio.com/docs/?dv=win) 
  + 官網: https://code.visualstudio.com/docs/?dv=win
  + VSCode 基本操作與使用
    + 安裝 PHP 程式语言開發模組
      + File -> Preferences -> Extensions
      + 輸入 「PHP」，選擇 「PHP IntelliSense」，再按下「Install」按鍵 
    + 開新檔案 Ex1.php，輸入下列程式碼:
      ```php
        <?php
          phpinfo();
        ?>
    + 存檔後，送上 github

#### 參考文獻
##### Visual Studio Code
+ [VS Code 官網](https://code.visualstudio.com/)
+ [安裝/設定 Visual Studio Code 編輯器](https://ithelp.ithome.com.tw/articles/10195139?sc=iThelpR)
+ [推薦的 VS Code Extensions 整理](https://medium.com/itsoktomakemistakes/vs-code-extensions-a453e5d1e926)
+ [Visual Studio Code 必裝擴充套件（Extensions）](https://blog.goodjack.tw/2018/03/visual-studio-code-extensions.html#markdown-%E7%9B%B8%E9%97%9C)
