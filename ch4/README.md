### 第四章 Git 版控與 GitHub 的應用
#### 版控的觀念與使用
+ 關於版本控制
  + 版本控制是一個能夠記錄一個或一組檔案在某一段時間的變更，使得讀者以後能取回特定版本的系統。
  + 使用者幾乎可以針對電腦上任意型態的檔案做版本控制。
  + 若使用者是繪圖或網頁設計師且想要記錄每一版影像或版面配置，採用版本控制系統 (VCS) 做這件事是非常明智的。
+ 本地端版本控制
  + 不建議使用檔案複製方式進行版本控制
  + 本地端版本控制流程圖
  
     ![本地端版本控制流程](img/1.png)
  + 這種版本控制工具中最流行的是 *rcs*，目前仍存在於許多電腦。
    + 此工具基本上以特殊的格式記錄修補集合 (patch set，即檔案從一個版本變更到另一個版本所需資訊)，並儲存於磁碟上。
+ 集中式版本控制系統
  + 接下來遇到的主要問題是需要在多種其它系統上的開發協同作業。
  + 集中式版本控制系統 (Centralized Version Control Systems，簡稱CVCSs) 被發展出來。
  + 如：CVS, Subversion 及 Perforce 皆具備單一伺服器，記錄所有版本的檔案，且有多個客戶端從伺服器從伺服器取出檔案。
  + 集中式版本控制系統流程圖
  
     ![集中式版本控制系統](img/2.png)
  + 優點：
    + 每個人皆能得知其它人對此專案做了些什麼修改有一定程度的瞭解。
    + 管理員可調整存取權限，限制各使用者能做的事。
    + 維護集中式版本控制系統也比維護散落在各使用者端的資料庫來的容易。
  + 缺點：
    + 如果伺服器當機一個小時，在這段時間中沒有人能進行協同開發的工作或者將變更的部份傳遞給其他使用者。
    + 如果伺服器用來儲存資料庫的硬碟損毀，就沒有相關的備份資料。
    + 如果伺服器故障，除了使用者已取到本地端電腦的版本外，包含該專案開發的歷史的所有資訊都會遺失。
+ 分散式版本控制系統
  + 分散式版本控制系統 (Distributed Version Control Systems, 簡稱DVCSs) 
  + 如：Git, Mercurial, Bazaar、Darcs
  + 客戶端不只是取出最後一版的檔案，而是完整複製整個儲存庫。
  + 整個系統賴以運作的電腦損毀，皆可將任何一個客戶端先前複製的資料還原到伺服器。
  + 分散式版本控制系統流程圖

     ![分散式版本控制系統](img/3.png)
    + 優點：
      + 使用者能同時與許多不同群組的人們協同開發同一個專案。
      + 允許使用者設定多種集中式系統做不到的工作流程，如：階層式模式。
  
+ Git 基礎要點
  + 記錄檔案快照，而不是差異
    + Git 將檔案儲存，視為小型檔案系統的一組快照（Snapshot）。
    + 每當提交（commit）時，Git 會紀錄下所有目前檔案的樣子，並且參照到這次快照中。
    + 為了講求效率，只要檔案沒有變更，Git 不會再度儲存該檔案，而是直接將上一次相同的檔案參照到這次快照中。
    + Git將檔案存成許多次的快照
  
       ![Git將檔案存成許多次的快照](img/4.png)
  + 大部份的操作皆可在本地端完成
    + 大部份 Git 的操作皆只需要本地端的檔案及資源即可完成，通常並不需要網路上其它電腦的資訊。
    + 想要瀏覽專案的歷史時，Git 不需要到伺服器下載歷史再顯示，就只需要從本機的資料庫讀取。
    + 等可連上網路時，再從本機連至伺服器，更新軟體版本！
  + Git 能檢查完整性
    + 在 Git 中所有的物件在儲存前都會被計算校驗碼（checksum）並以校驗碼參照物件。
    + Git 用來計算校驗碼的機制稱為 SHA-1 雜湊演算法。
    + 一個校驗碼是由 40 個 16 進位的字母（0-9 和 a-f）所組成，Git 會根據檔案的內容和資料夾的結構來計算。
    + Git 中到處都看到校驗碼，因為校驗碼被 Git 到處使用。
  + Git 通常只增加資料
    + 當使用 Git 時，幾乎所有的動作都只是增加資料到Git的資料庫。
    + 只要提交快照到 Git 後，很難會發生遺失的情況!
  + 三種狀態
    + Git 會把檔案標記為三種主要的狀態：已提交（committed）、已修改（modified）及已預存（staged）。
      + 已提交代表這檔案己安全地存在本地端資料庫。
      + 己修改代表這檔案已被修改但尚未提交到本地端資料庫。
      + 已預存代表這檔案將會被存到下次提交的快照中。
    + Git 專案的三個主要區域：Git 資料夾、工作目錄（working directory）以及預存區（staging area）。
      
       ![Git 三個主要區域](img/5.png)
      + Git 資料夾是 Git 用來儲存專案的後設資料及物件資料庫的地方。
      + 工作目錄是專案被檢出的某一個版本。
      + 預存區是一個單一檔案，一般來說放在 Git 目錄下，儲存關於下次提交的資訊。 有時它會稱為索引「index」，但現在更常被稱呼為預存區。
    + 基本 Git 工作流程大致如下：
    　1. 在工作目錄修改檔案。
    　2. 預存檔案，將檔案的快照新增到預存區。
    　3. 做提交的動作，這會讓存在預存區的檔案快照永久地儲存在 Git 目錄中。

#### 使用 Git 指令
+ 初次設定 Git
  + Git 附帶一個名為 git config 的工具，讓使用者能夠取得和設定組態參數。
  + 這些參數被存放在下列三個地方：
    + 檔案 /etc/gitconfig：裡面包含該系統所有使用者和使用者倉儲的預設設定。如果傳遞 --system 參數給 git config，就會明確地從這個檔案讀取或寫入設定。
    + 檔案 \~/.gitconfig、\~/.config/git/config：使用者帳號專用的設定。只要傳遞 --global，就會明確地讓 Git 從這個檔案讀取或寫入設定！
    + 任何倉儲中 Git 資料夾的 config 檔案（位於 .git/config）：這個倉儲的專用設定。
    + 每個層級的設定皆覆蓋先前的設定，所以在 .git/config 的設定優先權高於在 /etc/gitconfig 裡的設定。
  + 設定識別資料
    + 安裝 Git 後首先應該做的事是設定使用者名稱及電子郵件。
    + 設定指令：(文字介面中的使用方式)
      <pre><code>$ git config --global user.name "John Doe"
      $ git config --global user.email johndoe@example.com</code></pre>
  + 指定編輯器
    + 可設定預設的文書編輯器，當 Git 需要使用者輸入訊息時會使用它。
    + 預設情況下，Git 會使用系統預設的編輯器。
    + 可手動修改：(Linux)
    　<pre><code>$ git config --global core.editor emacs</code></pre>
    + 可手動修改：(Windows)
    　<pre><code>$ git config --global core.editor "'C:/Program Files(x86)/Notepad++/notepad++.exe' -multiInst -nosession"</code></pre>
  + 檢查讀者的設定
    + 使用命令列出 Git 在目前位置能找到的設定值：
    　<pre><code>$ git config --list
    $ git config user.name</code></pre>
  + 取得說明文件
    + 使用說明文件的方法：
    　<pre><code>$ git help \<verb\>
    $ git \<verb\> --help
    $ man git-\<verb\>
    $ git help config</code></pre>

+ 取得一個 Git 倉儲
  + 有兩種主要方法來取得一個 Git 倉儲。
    + 將現有的專案或者資料夾匯入 Git
    + 從其它伺服器克隆（clone）一份現有的 Git 倉儲。
  + 在現有資料夾中初始化倉儲
    + 只需要進入該專案的資料夾並執行：<pre><code>$ git init</code></pre>
      + 這個命令將會建立一個名為 .git 的子資料夾，其中包含 Git 所有必需的倉儲檔案，也就是 Git 倉儲的骨架。
    + 如果專案資料夾原本已經有檔案（不是空的），那麼應該馬上追蹤這些原本就有的檔案，然後進行第一次提交。<pre><code>$ git add .
  $ git commit -m 'initial project version'</code></pre>
  + 克隆現有的倉儲
    + 取得現有 Git 倉儲的複本:<pre><code>$ git clone \<url\></code></pre>
    + 例：<pre><code>$ git clone https://github.com/libgit2/libgit2 </code></pre>
      + 這指令將會建立名為「libgit2」的資料夾，並在這個資料夾下初始化一個 .git 資料夾，從遠端倉儲拉取所有資料，並且取出（checkout）專案中最新的版本。
      + 若想要將倉儲克隆到「libgit2」以外名字的資料夾，只需要再多指定一個參數即可：<pre><code>$ git clone https://github.com/libgit2/libgit2 mylibgit</code></pre>

+ 紀錄變更到版本庫中
  + 每當修改檔案到一個想記錄它的階段時，就需要提交（commit）這些變更的快照到版本庫中。
  + 工作目錄下的每個檔案不外乎兩種狀態：已追蹤、未追蹤。
    + 「已追蹤」檔案是指那些在上次快照中的檔案：它們的狀態可能是「未修改」、「已修改」、「已預存（staged）」
    + 「未追蹤」則是其它以外的檔案—在工作目錄中，卻不包含在上次的快照中，也不在預存區（staging area）中的任何檔案
    + 檔案狀態的生命週期：
  
       ![檔案狀態的生命週期](img/6.png)
    + 當第一次克隆（clone）一個版本庫時，所有檔案都是「已追蹤」且「未修改」，因為 Git 剛剛檢出它們並且尚未編輯過任何檔案。
  + 檢查檔案狀態
    + **git status** 命令是用來偵測哪些檔案處在什麼樣的狀態下的主要工具
  + 追蹤新的檔案
    + 例：新增一個 README 檔案
      <pre><code>#git add README
      #git status</code></pre>
      + 可以看到 README 檔案現在是準備好被提交的「已追蹤」和「已預存」狀態
      + 若再次修改 README 檔案後，需要再次使用 **git add** 指令，將檔案再次列入「已追蹤」和「已預存」狀態
  + 忽略不需要的檔案
    + 編寫 .gitignore 檔案，在該檔中列舉符合這些檔名的模式（pattern），可忽略不需提交的檔案！
    + 編寫 .gitignore 檔案的模式規則如下：
      + 空白列，或者以 # 開頭的列會被忽略。
      + 可使用標準的 Glob 模式。
      + 以斜線（/）開頭以避免路徑遞迴。
      + 以斜線（/）結尾代表是目錄。
      + 以驚嘆號（!）開頭表示將模式規則反向。
      + 例：
        <pre><code>#不要追蹤檔名為 .a 結尾的檔案
        *.a
        
        #但是要追蹤 lib.a，即使上面已指定忽略所有的 .a 檔案
        !lib.a
        
        #只忽略根目錄下的 TODO 檔案，不包含子目錄下的 TODO
        /TODO
        
        #忽略 build/ 目錄下所有檔案
        build/
        
        #忽略 doc/notes.txt，但不包含 doc/server/arch.txt
        doc/*.txt
        
        #忽略所有在 doc/ 目錄底下的 .pdf 檔案
        doc/**/*.pdf</code></pre>
  + 檢視已預存及未預存的檔案
    + **git diff** 可顯示檔案裡的哪些列被加入或刪除
      + 這命令會比對「工作目錄」和「預存區」之間的版本， 然後顯示尚未被存入預存區的修改內容。
    + 檢視已經預存而接下來將會被提交的內容，可以使用 **git diff --staged**
      + 這個命令比對的對象是「預存區」和「最後一次提交」。
    + 使用 **git diff --cached** 檢視哪些部分是已預存的（--staged 和 --cached 是同義選項）
  + 提交修改
    + 預存區內的檔案，可以利用指令 **git commit** 開始提交
      + 這麼做會啟動選定的編輯器，編寫提交訊息！
      + 使用 **git config --global core.editor** 命令可以指定任何一個想使用的編輯器！
    + 尚未用 **git add** 預存的—將不會納入本次的提交中
    + 可在 **git commit** 命令的 -m 選項後方直接輸入提交訊息
      + 例：<pre><code>#git commit -m "Hello Kitty"</code></pre>
  + 移除檔案
    + 要從 Git 中刪除一個檔案，需要將它從已追蹤檔案中移除，然後再提交
    + 例：<pre><code>#rm README
      #git status
      #git rm READE
      #git status</code></pre>
  + 移動檔案
    + Git 可以在檔案移動後很聰明地將它們找出來
    + 例：<pre><code>#git mv README README.md
      #git status</code></pre>

#### 使用 GitHub 站台儲放程式碼
+ 與遠端協同工作
  + 遠端版本庫是指被託管在網際網路或其他網路中的各種專案版本庫。
  + 與其它人協同工作包括：「管理」遠端版本庫、以及將分享的資料「推送（push）」到端遠版本庫、或者從遠端版本庫「拉取（pull）」分享的資料。
  + 管理遠端版本庫則包括了了解如何：「新增」遠端版本庫、「移除」不再有效的遠端版本庫、管理各式各樣的「遠端分支」、定義遠端分支是否被「追蹤」等等。

+ 顯示遠端
  + 使用 **git remote** 命令可以檢視已經設定好的遠端版本庫，它會列出每個遠端版本庫的「簡稱」。
  + 看到「origin」—表示是 Git 給定的預設簡稱
  + 例：<pre><code>#cd PHPExercise
    #git remote -v</code></pre>
    
+ 新增遠端版本庫
  + 執行 **git remote add <簡稱> \<url\>** 來新增:
    <pre><code>#git remote add phpexerise https://github.com/antallen/PHPexerise.git
    #git remote -v
    phpexerise	https://github.com/antallen/PHPexerise.git (fetch)
    phpexerise	https://github.com/antallen/PHPexerise.git (push)
    </code></pre>
  + 從遠端版本庫中取得所有資訊，而這些資訊並不存在於本地端的版本庫中：
    <pre><code>#git fetch phpexerise
    From https://github.com/antallen/PHPexerise
    * [new branch]      master     -> phpexerise/master
    </code></pre>
  + 這個命令會連到遠端專案，然後從遠端專案中將本地端還沒有的資料全部拉下來
  + 執行完成後，應該會有遠端版本庫中所有分支的參照（reference）

+ 從遠端獲取或拉取
  + **git fetch <簡稱>**  這指令會獲取（fetch）在使用者複製 clone（或者最後一次獲取）之後任何被推送到伺服器上的新的工作內容。
  + **git fetch** 命令只會下載資料到本地端版本庫—它並不會自動合併任何工作內容，也不會自動修改使用者正在修改的東西
  + 使用 **git pull** 命令來自動「獲取」並「合併」那個遠端分支到目前的本地端分支
  + **git clone** 這個命令會「自動地」將本地分支 master 設定為「追蹤」遠端版本庫上的 master！

+ 推送到遠端
  + 推送的命令：**git push [remote-name] [branch-name]**
  + 想要將 master 分支推送到 phpexerise 伺服器上時,可以執行下列命今將所有完成的提交（commit）推送回伺服器上 :
    <pre><code>#git push phpexerise master</code></pre>
  + 如果有人更早推送到這個遠端的 master 上，則必須先 pull 遠端的版本庫下來，並整併(merge)到本地端的版本庫之後，才可以再推送上去！
  
+ 檢視遠端
  + 使用 **git remote show [remote-name]** 命令可以檢視特定遠端更多資訊！
    <pre><code>$ git remote show phpexerise
    * remote phpexerise
    Fetch URL: https://github.com/antallen/PHPexerise.git
    Push  URL: https://github.com/antallen/PHPexerise.git
    HEAD branch: master
    Remote branch:
      master tracked
    Local branch configured for 'git pull':
      master merges with remote master
    Local ref configured for 'git push':
      master pushes to master (up to date)</code></pre>

+ 移除或重新命名遠端
  + 執行 **git remote rename** 來重新命名遠端的簡稱。
  + 例如：
    <pre><code>#git remote rename phpexerise phpproject
    #git remote -v</code></pre>
  + 移除一個遠端，可以執行 **git remote rm** ：
    <pre><code>#git remote rm phpproject
    #git remote -v</code></pre>

#### 使用 MarkDown 語法
+ 概述
  + 哲學
    + Markdown的目標是實現「易讀易寫」。
    + Markdown的語法全由標點符號所組成，並經過嚴謹慎選，是為了讓它們看起來就像所要表達的意思。
  
  + 行內HTML
    + Markdown的語法有個主要的目的：用來作為一種網路內容的寫作用語言。
    + HTML 是一種發佈的格式，Markdown是一種編寫的格式！
    + 不在Markdown涵蓋範圍之外的標籤，都可以直接在文件裡面用HTML撰寫。
    + 只有區塊元素──比如\<div\>、\<table\>、\<pre\>、\<p\>等標籤，必需在前後加上空行，以利與內容區隔。
    + Markdown語法在HTML區塊標籤中將不會被進行處理。
    + HTML的區段標籤如\<span\>、\<cite\>、\<del\>則不受限制，可以在Markdown的段落、清單或是標題裡任意使用。
    + HTML區段標籤和區塊標籤不同，在區段標籤的範圍內，Markdown的語法是有效的。
  
  + 特殊字元自動轉換
    + 在HTML文件中，有兩個字元需要特殊處理：\< 和 \&。
    + \< 符號用於起始標籤， \&符號則用於標記HTML實體 :
      + 如果只是想要使用這些符號，必須要使用實體的形式，例如：「\<」是「\&lt;」，而 「\&」則是「\&amp;」。
    + Markdown允許直接使用這些符號，但是要小心跳脫字元「\」的使用
    + code範圍內，不論是行內還是區塊，\< 和 \& 兩個符號都一定會被轉換成HTML實體
    + 結論：在HTML語法中，你要把所有的 \< 和 \& 都轉換為 HTML 實體，才能 **「在 HTML 文件裡面寫出HTML code」**。
  
+ 區塊元素
  + 段落和換行
    + 一個段落是由一個以上相連接的行句組成，而**一個以上的空行則會切分出不同的段落**，一般的段落不需要用空白或斷行縮排。
    + Markdown允許段落內的**強迫斷行，只要在行尾加上兩個以上的空白**，然後按「enter」。

  + 標題
    + Markdown支援兩種標題的語法，**Setext** 和 **atx** 形式。
      + **Setext**:Setext形式是用底線的形式，利用=（最高階標題）和-（第二階標題）
        + 例：

          This is an H1
          ============
          This is an H2
          -------------

          + 上例原始碼：
            <pre><code>
            This is an H1
            \============
            This is an H2
            \-------------
            </code></pre>
        +  任何數量的=和-都可以有效果。
  
      + **atx**:
        + Atx形式則是在行首插入1到6個 # ，各對應到標題1到6階，例如：
          # This is heading 1  
          ## This is heading 2  
          ### This is heading 3  
          #### This is heading 4  
          + 以上範例原始碼如下：
            <pre><code># This is heading 1
            ## This is heading 2  
            ### This is heading 3 
            #### This is heading 4 </code></pre>
        + 可以選擇性地「關閉」atx樣式的標題，只要行尾加上#，而行尾的#數量也不用和開頭一樣！

  + 區塊引言
    + Markdown 使用 email 形式的區塊引言
    + 例：
  
      > This is a book.
      >> 這是引言！

    + 上例原始碼: 
      <pre><code>\> This is a book.
      \>> 這是引言！
      </code></pre>
    + 引言的區塊內也可以使用其他的Markdown語法，包括標題、清單、程式碼區塊等

  + 清單
    + Markdown支援有序清單和無序清單。
    + 無序清單使用星號、加號或是減號作為清單標記：
        <pre><code>
        + A
        - B
        * C
        </code></pre>
    + 有序清單則使用數字接著一個英文句點：
        <pre><code>
        1. A
        2. B
        3. C
        </code></pre>
    + 清單項目標記通常是放在最左邊，但是其實也可以縮排，最多三個空白，項目標記後面則一定要接著至少一個空白或tab。
    + 清單項目可以包含多個段落，每個項目下的段落都必須縮排4個空白或是一個tab
    + 如果要在清單項目內放進引言，那 \> 就需要縮排
    + 如果要放程式碼區塊的話，該區塊就需要縮排兩次，也就是8個空白或是兩個tab

  + 程式碼區塊
    + Markdown會用\<pre\>和\<code\>標籤來把程式碼區塊包起來。
      + 例：
        ```php
        <pre><code>
        <?php 
          print("Hello"); 
        ?>
        </code></pre>
    + 一個程式碼區塊會一直持續到沒有縮排的那一行
    + 在程式碼區塊裡面，\&、\<和\>會自動轉成HTML實體
      + 這樣的方式讓使用者非常容易使用Markdown插入範例用的HTML原始碼，只需要複製貼上，再加上縮排就可以了
    + 分隔線
      + 可以在一行中用三個或以上的星號、減號、底線來建立一個分隔線，行內不能有其他東西。
      + 例：
        <pre><code>
          \----------
          \***********
          \__________
        </code></code>

+ 區段元素
  + 連結
    + Markdown支援兩種形式的連結語法：行內和參考兩種形式。
    + 不管是哪一種，連結的文字都是用 [方括號] 來標記。
      + 例如：
        <pre><code>
        his is [an example](http://example.com/ "Title") inline link.
        [This link](http://example.net/) has no title attribute.
        </code></pre>
    + 參考形式的連結使用另外一個方括號接在連結文字的括號後面，而在第二個方括號裡面要填入用以辨識連結的標籤：
      <pre><code>
        This is [an example][id] reference-style link.
      </code></pre>
      + 接著，在文件的任意處，可以把這個標籤的連結內容定義出來：
        <pre><code>[id]: http://example.com/  "Optional Title Here"</code></pre>

  + 強調
    + Markdown使用星號（*）和底線（_）作為標記強調字詞的符號
    + 被 \* 或 \_ 包圍的字詞會被轉成用\<em\>標籤包圍，用兩個 \* 或 \_ 包起來的話，則會被轉成\<strong\>
  
  + 程式碼片段
    + 如果要標記一小段行內程式碼，可以用反引號把它包起來（`），例如：
      <pre><code>Use the `printf()` function.
      </code></pre>
    + 如果是指定某一種程式語言，使用前三個倒引號 ('`') 字元之後的別名定義要使用的語法。例：
      ```php
      <?php 
         print("Heelo");
      ?>
      ```
      + 上例原始碼：
        <pre><code>```php
          <\?php 
            printf("Heelo");
          \?>
          ```</code></pre>
      + 支援的語法，簡略摘錄如下：

        |Name	| Markdown 標籤|
        |:---:|:---:|
        |Bash |	bash|
        |C++|cpp|
        |Docker	|dockerfile|
        |Go	|go|
        |HTML	|html|
        |HTTP	|http|
        |Java	|java|
        |JavaScript	|javascript|
        |JSON	|json|
        |Markdown	|md|
        |PHP	|php|
        |Python	|python|
        |SQL	|sql|
        |XML	|xml|

  + 圖片
    + Markdown使用一種和連結很相似的語法來標記圖片，同樣也允許兩種樣式：行內和參考。
    + 行內圖片的語法看起來像是：
      ```md
      ![Alt text](/path/to/img.jpg)
      ![Alt text](/path/to/img.jpg "Optional title")
    + 參考式的圖片語法則長得像這樣：
      ```md
      ![Alt text][id]
      [id]: url/to/image  "Optional title attribute"
    + Markdown還沒有辦法指定圖片的寬高，如果需要，可以使用普通的<img>標籤。

  + 表格
    + 表格不是核心 Markdown 規格的一部分，但可以使用管線 (|) 和連字號 (-) 字元來建立表格。
    + 例：
      ```md
      | Fun                  | With                 | Tables          |
      | :------------------- | -------------------: |:---------------:|
      | left-aligned column  | right-aligned column | centered column |
      | $100                 | $100                 | $100            |
      | $10                  | $10                  | $10             |
      | $1                   | $1                   | $1              |

#### 參考文獻
##### MarkDown
+ [Markdown 語法說明](https://markdown.tw/#code)
+ [如何使用 Markdown 來撰寫 Docs](https://docs.microsoft.com/zh-tw/contribute/how-to-write-use-markdown)
##### Git
+ [Git 官網說明](https://git-scm.com/book/zh-tw/v2)
  + [舊版的官網](https://git-scm.com/book/zh-tw/v1/%E9%96%8B%E5%A7%8B)
+ [開始程式碼版控](https://ithelp.ithome.com.tw/articles/10202278)
+ [為自己學 Git](https://gitbook.tw/)