# TECHIS出席管理システム

## 概要
TECHIS内での生徒の出席を管理するシステムです。

## ダウンロード
```
git clone https://github.com/tech-is/attend_system.git
```

# バーコードリーダーシステム

## 概要
raspberry pi内でシステムを運用し、1次元バーコードをスキャナーで読み込むことによって、kintoneに生徒の出席状況を記録する

## 環境構成
```
・Python >= 3.7.3
・MYSQL 10.1.38-MariaDB
```

## 外部ライブラリ
src/python/requirements.txtをpipで読み込んでください
```
mysql-connector-python=>8.0.18
pynput=>1.6.0
```

## データベース構築
/sql 内のdumpファイルをリストアしてください

## 設定項目
ローカルDBと接続する際は下記のjsonファイルを編集してください
/src/python/config/database.json
```
{
    "host": "[接続先ホスト]",
    "port": "[ポート番号]",
    "user": "[DBユーザー名]",
    "password": "[DBパスワード]",
    "database": "[DB名]"
}
```

kintoneAPIにリクエストを送る際は下記のjsonファイルを編集してください
/src/python/config/setting.json
```
{
    "header": {
        "X-Cybozu-API-Token": "[APItoken]",
        "Content-Type": "application/json"
    },
    "students": {
        "url": "[requestURL]}",
        "params": {
            "app": "[アプリID]",
            "fields": [
                "student_id",
                "Name",
                "barcode"
            ],
            "query": "order by student_id asc",
            "totalCount": true
    },
    "GET": {
        "url": "[requestURL]",
        "app": "[アプリID]"
    },
    "POST": {
        "url": "[requestURL]",
        "app": "[アプリID]"
    },
    "PUT": {
        "url": "[requestURL]",
        "app": "[アプリID]"
    }
}
```


# ローカル用CMS

## kintoneと連携予定のため廃止するか検討中

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
/sql 内のdumpファイルをリストアしてください


## ドキュメントパス設定
src\application\config\development\config.php
```
$config['base_url'] = 'localhost' //ここに展開先のホストを記述する
```

## フォルダ構成
```
src
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
