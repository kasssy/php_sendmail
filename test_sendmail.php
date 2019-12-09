<?php
/**
 * @test Gmail(STMP)でのメール送信
 * @memo reply.kishimoto.kouichi51@gmail.com(SMTP)から誰か(kishimoto.kouichi51@gmail.com)へ
 *
 * @memo (README)設定手順、使い方
 * 1. GMail設定にて、"安全性の低いアプリのアクセス"を「許可」しておく。
 *    <https://myaccount.google.com/lesssecureapps>
 *    (*)しておかないとブロックされて、SMTP認証エラー`SMTP Error: Could not authenticate`が発生する。
 *
 * 2. サーバの任意の箇所へ、当ファイルを配置する。
 * ```
 * $ composer require phpmailer/phpmailer
 * ```
 *
 * 3. SMTP設定($config)を変更する。
 *
 * 4. テスト送信する。
 * ```
 * $ php test_sendmail.php
 * ```
 *
 */
require_once( dirname( __FILE__ ).'/vendor/phpmailer/phpmailer/src/PHPMailer.php' );
require_once( dirname( __FILE__ ).'/vendor/phpmailer/phpmailer/src/Exception.php' );
require_once( dirname( __FILE__ ).'/vendor/phpmailer/phpmailer/src/SMTP.php' );

// SMTP設定情報
$config = new \stdClass();
$config->username  = "from@gmail.com";
$config->useralias = "kasssy-Gmail";
$config->password  = "passwd";

$info = new \stdClass();
$info->to      = "to@test.com";
$info->subject = "テスト件名";
$info->message = "GMailからの送信テストです。";

send_mail_to_guest($config, $info);


function send_mail_to_guest($config, $info) {
    $mailer = new \PHPMailer\PHPMailer\PHPMailer(true);
    $mailer->CharSet = "iso-2022-jp-ms";
    $mailer->Encoding = "7bit";
    $mailer->IsSMTP();
    $mailer->Host = "smtp.gmail.com";
    $mailer->SMTPAuth = true;
    $mailer->SMTPDebug = 2;
    $mailer->SMTPSecure = "tls";
    $mailer->Port = 587;
    $mailer->Username = $config->username;
    $mailer->Password = $config->password;
    $mailer->setFrom($config->username, $config->useralias);

    $to = $info->to;
    $subject = $info->subject;
    $body = $info->message ."\r\n"
        . "\r\n"
        . "------------------------------\r\n"
        . "テストメールですので無視してください、\r\n"
        . "------------------------------\r\n"
        . "\r\n"
    ;

    $mailer->AddAddress($to);
    $mailer->Subject = mb_encode_mimeheader($subject, 'iso-2022-jp-ms');
    $mailer->Body    = mb_convert_encoding($body, "iso-2022-jp-ms", "utf-8" );

    $mailer->Send();
}