# TECHIS出席管理システム

## 概要
TECHIS内での生徒の出席を管理するシステムです。

## ダウンロード
```
git clone https://github.com/tech-is/attend_system.git
```

## 環境構成
```
・apache
・PHP > 7.3
・MYSQL 10.1.38-MariaDB
・Codeigniter 3.x
```
## 導入方法
apacheのDocummentRoot内に当プロジェクトを展開してください  
.htaccessの設定を読み込めるようにapacheの設定を変更してください  

httpd.confをエディタ等で開いてプロジェクトを展開しているDocumentrootの設定を
```
-     AllowOverride None
+     AllowOverride All
```
に変更して

```
- #LoadModule rewrite_module lib/httpd/modules/mod_rewrite.so
+ LoadModule rewrite_module lib/httpd/modules/mod_rewrite.so
```
のようにコメントアウトを外してモジュールを有効化してください  
その後apacheを再起動してください
## データベース構築
dumpファイルをどこに置くか検討中

## フォルダ構成
```
├─application
│  ├─cache
│  ├─config
│  ├─controllers //コントローラー
│  ├─core
│  ├─helpers
│  ├─hooks
│  ├─language
│  ├─librarie
│  ├─logs
│  ├─models //モデル
│  ├─third_party
│  └─views
├─assets //cssやjs
│  ├─cms
│  ├─css
│  ├─images
│  ├─js
│  ├─php
│  ├─plugins
│  ├─scss
│  └─sounds
├─system //システム関連は編集不可
│  ├─core
│  ├─database
│  ├─fonts
│  ├─helpers
│  ├─language
│  └─libraries
└─user_guide
```

## コントローラー構成
```
Students.php // 生徒の情報を主に処理するコントローラー

Attend.php // 出退席を主に処理するコントローラー

```
