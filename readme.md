# Animarl
## Animarl(アニマール)とは
ペットサロン事業者向けの顧客管理システムです

## ダウンロード
GitHubからダウンロードするかgit cloneしてください  
ダウンロード先  
https://github.com/tech-is/teamWM/archive/master.zip

git cloneする場合
```
git clone https://github.com/tech-is/teamWM
```
## 環境構成
```
・apache
・PHP 7.x
・MYSQL 10.1.38-MariaDB
・Codeigniter 3.x
```
## 導入方法
apacheのDocummentRoot内に当プロジェクトを展開してください  
.htaccessの設定を読み込めるようにサーバーの設定を変更してください  
  
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
database.txtに記述しているSQL文をMysqlを立ち上げて実行してください  
ターミナルで行う場合  
```
mysql -u root -p パスワード
MariaDB[(none)] ここにSQLを貼り付けて実行
```
## フォルダ構成
・application/  
　　・config/　デフォルトコントローラーの設定やデータベースの設定ファイルを置いています  
　　・controler/　コントローラーのフォルダ  
　　・model/　データベース周りの関数をまとめたクラスを置いているフォルダ  
　　・views/　フロントエンドファイルをまとめたフォルダ  
・system/ ライブラリやヘルパーを置いているフォルダ  
・assets/ 静的ファイルをおいているフォルダ  
　　・CMS/　CMS本体のcssとjsを置いています  
・index.php　最初にこのファイルを読み込んでください  
・database.txt　データベースを構築するSQL文を記述しています  