<?php
// 设置Content-Type为JSON格式
header('Content-Type: application/json');

// 获取所有HTTP头信息
$headers = getallheaders();

// 获取用户的IP地址
$user_ip = $_SERVER['REMOTE_ADDR'];

// 获取用户连接使用的协议
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https' : 'http';

// 准备返回的数据
$response = [
    'ip' => $user_ip,
    'protocol' => $protocol,
    'headers' => $headers
];

// 转换为JSON格式并输出
echo json_encode($response);
?>
