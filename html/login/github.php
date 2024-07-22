l
<?php
// 获取授权码，根据自己的回调地址获取
$code = $_GET['code'];

// 认证请求地址
$token_url = 'https://github.com/login/oauth/access_token';
// 获取用户信息请求地址
$user_url = 'https://api.github.com/user';

// 应用的 Client ID 和 Client Secret
$client_id = 'c9cbb49f280cecfd3a7e';
$client_secret = '8c7cae46d80174539256f0a145bf8b6f0f955c75';

// 请求访问令牌
$token_params = array(
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'code' => $code
);

$token_headers = array(
    'Accept: application/json'
);

$token_options = array(
    'http' => array(
        'method' => 'POST',
        'header' => implode("\r\n", $token_headers),
        'content' => http_build_query($token_params),
        'ignore_errors' => true
    )
);

$token_context = stream_context_create($token_options);
$token_response = file_get_contents($token_url, false, $token_context);
$token_data = json_decode($token_response, true);
$access_token = $token_data['access_token'];

// 请求用户信息
$user_headers = array(
    'Authorization: token ' . $access_token,
    'User-Agent: 续梦网'
);

$user_options = array(
    'http' => array(
        'method' => 'GET',
        'header' => implode("\r\n", $user_headers),
        'ignore_errors' => true
    )
);

$user_context = stream_context_create($user_options);
$user_response = file_get_contents($user_url, false, $user_context);
$user_data = json_decode($user_response, true);

// 输出用户信息
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
print_r($user_data);
$name = $user_data['name'] ?: $user_data['login'];
$github = $user_data['id'];
echo $github;
if (!empty($_SERVER['HTTP_CLIENT_IP']))
  {
    $ip=$_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
  {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else
  {
    $ip=$_SERVER['REMOTE_ADDR'];
  }
if ($github){
 $user_num = $con->query(" SELECT * FROM `user` WHERE `github` = '$github'")->num_rows;
 $user_mss = $con->query(" SELECT * FROM `user` WHERE `github` = '$github'")->num_rows;
 //var_dump($_SESSION['baidu_uid']);
// var_dump($baidu_id);
//var_dump($user_num);
    if ($user_num > 0){
    $con->query("UPDATE `user` SET `name` = '".$name."', `github_avatar` = '".$user_data['avatar_url']."', `pol` = '未知' WHERE `github` = '$github'");
     setcookie('BAEID', $github, time()+86400*365, '/', 'rmct.cn');  
$user_mss = $con->query(" SELECT * FROM `user` WHERE `github` = '$github'")->fetch_assoc();
     $con->query("INSERT INTO `log_auth` (`id_user`, `time`, `type`, `ip`) VALUES ('".$user_mss['id']."', '".time()."', '1', '".$ip."')");
    }else{
      $us = $con->query("INSERT INTO `user` (`id`, `github`, `name`, `github_avatar`, `pol`, `data_reg`) VALUES (NULL, '{$github}', '{$name}', '{$user_data['avatar_url']}', '未知', '".time()."')");
      setcookie('BAEID', $github, time()+86400*365, '/','rmct.cn');  
      $con->query("INSERT INTO `log_auth` (`id_user`, `time`, `type`, `ip`) VALUES ('".$us['id']."', '".time()."', '1', '".$ip."')");

 }
 }
?>