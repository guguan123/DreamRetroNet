<?php
   //Step1：获取Authorization Code 
   session_start(); 
   require_once 'qq/config.php';
   //require_once("Connect/API/qqConnectAPI.php");
   $code = $_REQUEST["code"];//存放Authorization Code 
   if(empty($code)) 
   { 
    //state参数用于防止CSRF攻击，成功授权后回调时会原样带回 
    $_SESSION['state'] = md5(uniqid(rand(), TRUE)); 
    //拼接URL 
    $dialog_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=" 
     . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state=" 
     . $_SESSION['state']; 
    echo("<script> top.location.href='" . $dialog_url . "'</script>"); 
   } 
 
   //Step2：通过Authorization Code获取Access Token 
   if($_REQUEST['state'] == $_SESSION['state'] || 1) 
   { 
    //拼接URL 
    $token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&" 
     . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url) 
     . "&client_secret=" . $app_secret . "&code=" . $code; 
    $response = file_get_contents($token_url); 
    if (strpos($response, "callback") !== false)//如果登录用户临时改变主意取消了，返回true!==false,否则执行step3 
    { 
     $lpos = strpos($response, "("); 
     $rpos = strrpos($response, ")"); 
     $response = substr($response, $lpos + 1, $rpos - $lpos -1); 
     $msg = json_decode($response); 
     if (isset($msg->error)) 
     { 
      echo "<h3>error:</h3>" . $msg->error; 
      echo "<h3>msg :</h3>" . $msg->error_description; 
      exit; 
     } 
    } 
 
    //Step3：使用Access Token来获取用户的OpenID 
    $params = array(); 
    parse_str($response, $params);//把传回来的数据参数变量化 
    $graph_url = "https://graph.qq.com/oauth2.0/me?access_token=".$params['access_token']; 
    $str = file_get_contents($graph_url); 
    if (strpos($str, "callback") !== false) 
    { 
     $lpos = strpos($str, "("); 
     $rpos = strrpos($str, ")"); 
     $str = substr($str, $lpos + 1, $rpos - $lpos -1); 
    } 
    $user = json_decode($str);//存放返回的数据 client_id ，openid 
    if (isset($user->error)) 
    { 
     echo "<h3>error:</h3>" . $user->error; 
     echo "<h3>msg :</h3>" . $user->error_description; 
     exit; 
    } 
    //echo("Hello " . $user->openid); 
    //echo("Hello " . $params['access_token']); 
 
    //Step4：使用<span style="font-family: Arial, Helvetica, sans-serif;">openid,</span><span style="font-family: Arial, Helvetica, sans-serif;">access_token来获取所接受的用户信息。</span> 
    $user_data_url = "https://graph.qq.com/user/get_user_info?access_token={$params['access_token']}&oauth_consumer_key={$app_id}&openid={$user->openid}&format=json"; 
     
    $user_data = file_get_contents($user_data_url);//此为获取到的user信息 
    } 
    else 
    { 
     echo("The state does not match. You may be a victim of CSRF."); 
    } 
    $qc = new QC();
echo $qc->qq_callback();
echo $qc->get_openid();
echo $user_data;