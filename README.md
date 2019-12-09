# php_sendmail

Gmail(STMP)経由でメール送信するサンプルコードです。


## 設定手順、使い方
### 1. Gmail設定画面にて、以下の何れかを設定しておく。（アクセスを許可しおく）
<https://myaccount.google.com/lesssecureapps>

- **[非推奨]** "安全性の低いアプリのアクセス"を「許可」する。
- 二段階認証を有効にして、*アプリパスワード*を発行する。

## 2. サーバの任意の箇所へ、当ファイル`test_sendmai.php`を配置する。
```bash
## PHPMailerをインストール
$ composer require phpmailer/phpmailer
```

## 3. SMTP設定を変更する
`test_sendmai.php`内の`$config`を書き換えてください。


## 4. テスト送信する
```bash
## 送信前に、送信先`$info`は書き換えてください。
$ php test_sendmail.php
```

