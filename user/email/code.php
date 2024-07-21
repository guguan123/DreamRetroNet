<?php

// 加载PHPMailer库
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// 获取接收邮件的邮箱地址
$to_email = $_POST['email'];

// 生成随机的验证码
$verification_code = rand(100000, 999999);

// 配置邮件发送参数
$mail = new PHPMailer();
//$mail->isSMTP();
$mail->Charset = 'UTF-8';
$mail->SMTPAuth = true;
$mail->Host = 'mail.jvzh.cn';  // 邮件服务器地址
$mail->Port = 25;  // 邮件服务器端口
//$mail->SMTPSecure = 'tls';  // 邮件加密方式
$mail->Username = 'admin@jvzh.cn';  // 发件人邮箱账号
$mail->Password = 'Al347527227001';  // 发件人邮箱密码
$mail->setFrom('admin@jvzh.cn', '续梦网');  // 发件人信息
$mail->addAddress($to_email);  // 收件人邮箱地址
$mail->Subject = 'Verification Code';  // 邮件主题
$mail->Body = 'Your verification code is ' . $verification_code;  // 邮件内容

// 发送邮件
if (!$mail->send()) {
    echo '邮件发送失败！';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo '邮件发送成功！';
    // 将验证码存储到数据库或缓存中
    // ...
