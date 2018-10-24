# FishTalk
2018魚客松競賽團隊 Pacific Alliance
===
主題：永續漁業經營和認證的技術協助-聊天交友網站
---
![](https://i.imgur.com/3VgIzT7.png)

# 網站名稱
   FishTalk
   
# 會員身分
   漁產業者、研究人員、其他
  
# 網站頁面
* 登入/註冊
* 一般聊天交友
* 類似知識+的討論串
* 積分、等級制，完成增能課程可升等
  
# 資料庫設計
* **member 會員資料**
level 用來識別漁民等級，是否也用來區別漁民與研究人員？
(ex. 申請完帳號level=0，管理員審核後level=1)
  
1.共用欄位(member)

| *帳戶* (account)|密碼(password)|鹽 (salt)|名稱(username)|email|level|時區(zone)|自介(introduction)|身份(4種)(identity)|
|-|-|-|-|-|-|-|-|-|
| admin | ****** | 9wc5d2a0r8 | 管理員 | admin@gmail.com | 100 | Asia/Taipei | 擁有最高權限 | 0 |
| nsysucse | ****** | bf8f6s8b0s | 國立中山大學資訊工程系 | nsysu@nsysu.edu.tw | 100 | Asia/Taipei | 我是研究單位 | 1 |
| cse | ****** | r8f9d6s3z5 | 蘇王奕翔 | krisonepiece@nsysu.edu.tw | 0 | Asia/Taipei | 我是研究人員| 2 |
| taiwanNo.1  | ****** | rg8fdb5f6k | 台灣捕撈王 | taiwan@gmail.com | 1 | Asia/Taipei | 我是漁民 | 3 |
  
2.漁船(boat)

|*漁船編號* (number)|帳戶 (account)|船型(type)|捕撈魚種(spicies)|作業地點(location)|研究需求(requirement)|
|-|-|-|-|-|-|
  
3.研究人員(researcher)

|*人員編號* (number)|帳戶 (account)|研究單位帳號 (department)|研究專長(skill)|研究經驗(study)|實務經驗(practice)|方便聯絡時間(contact)|推薦信函(?)|
|-|-|-|-|-|-|-|-|
  
* **配對(matching)**

|*配對編號* (number)|帳戶A (account_A)|帳戶B (account_B)|同意配對 (accept)|配對時戳 (timestamp)|
|-|-|-|-|-|
說明：A 對 B 送邀請。
  
* **talk_content 聊天內容**

|*訊息編號* (number)|訊息傳送者A (account_A)|訊息接收者B (account_B)|聊天訊息 (message)|訊息時戳 (timestamp)|
|-|-|-|-|-|
  
* **評價(evaluation)**

|*評價編號* (number)|帳戶A (account_A)|帳戶B (account_B)|評價(1~5) (evaluation)|類別 (type)|評價時戳 (timestamp)|
|-|-|-|-|-|-|
說明：A 對 B 評價。
  
* **增能工具(tool)**

|*工具編號* (number)|工具名稱 (name)|工具說明 (note)|工具連結(url)|
|-|-|-|-|
  
* **學習(study)**

|*帳戶* (account)|*工具編號* (number)|完成時戳 (timestamp)|
|-|-|-|
  
* **forum 知識+討論區**

1.發問文章

|帖子名稱|發帖人|文章內容|發帖時間|
|-|-|-|-|
  
2.文章內容、回覆

|回帖人名稱|內容|回覆時間|
|-|-|-|
  
# 架構圖

![](https://imgur.com/88R0btj.png)

## 頁面
### 首頁

![](https://imgur.com/4iw5NTt.png)

### 歡迎頁面

![](https://imgur.com/bSAitP9.png)

### 會員管理

![](https://imgur.com/kfKtVdN.png)

# 流程圖
## 研究單位

![](https://imgur.com/9UCAwe3.png)

## 配對

![](https://imgur.com/b5XT6BX.png)

# 資源
* PHP 聊天室框架  
[workman-chat](https://github.com/walkor/workerman-chat)([DEMO](http://chat.workerman.net/)) - 支援多人、多聊天室、私聊  
[小蝌蚪聊天室](https://github.com/walkor/workerman-todpole)([DEMO](http://kedou.workerman.net/))-可以化身成小蝌蚪一起聊天XD  
[PHP-Chatroom](https://github.com/opw0011/PHP-Chatroom) - 支援多人，使用AngularJs框架  
[Chat2](https://github.com/CSS-Tricks/Chat2) - 支援多人、多聊天室  

* Bootstrap 樣板  
[Start Bootstrap](https://startbootstrap.com/)  

* icon  
[Font Awesome](https://fontawesome.com/) - 方便好用的圖示庫  
[Iconfinder](https://www.iconfinder.com/)  
[Icons8](https://icons8.com/) - 分類清楚，可依 icon 顏色搜尋  
[Material icons](https://material.io/icons/) - Material Design 官方 icon  
[Flaticon](https://www.flaticon.com/)  

* 背景/向量圖  
[freepik](https://www.freepik.com/) - 大量向量圖、背景、icons  
[StockSnap](https://stocksnap.io/) - 高清背景圖  
[illustAC](https://zh-tw.ac-illust.com/) - 大量高品質向量圖  

* 配色  
[Material UI](https://www.materialui.co/) - 收錄各種風格色票  
[LOL Colors](https://www.webdesignrankings.com/resources/lolcolors/) - 配色推薦  
[Colors](https://klart.io/colors/) - 配色推薦  
[HTML Color Codes](http://htmlcolorcodes.com/) - 選色器  

* 發佈  
[AppsGeyser](https://www.appsgeyser.com/) - 網頁快速轉APP([教學](http://blog.pulipuli.info/2013/08/appsgeyserandroid-app-using-appsgeyser.html))  
