<?php
session_start();
require_once 'baidu/config.php';
$getcode_url = "http://openapi.baidu.com/oauth/2.0/authorize?response_type=code&client_id=$api_key&redirect_uri=$redirect_url";

session_start();
require_once 'qq/config.php';
$qqcode_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=$app_id&redirect_uri=$my_url";
?>
<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '登录';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a>';
echo '<h1>'.$title.'</h1>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/user.php';
echo '<div id="nav"><span>位置：</span><span>'.$title.'</span></div>';
echo '<div id="wrapper" class="clearfix"><div id="main">';

echo '<ul class="list icon line margin-top top-white">';
?>
<li><a href="<?php echo $qqcode_url ?>">QQ登录</a></li>
<li><a href="#">微博登录</a></li>
<li><a href="<?php echo $getcode_url ?>">百度登录</a></li>
<li><a href="#">github登录</a></li>
</ul>
<?php
echo '<div class="message bg-white margin-top">访问本站即视为您同意<a href="/info/1">免责声明</a>
</div></div>
<div id="aside">
<div class="message bg-white">智能机和电脑可以直接访问<a href="https://jvzh.cn">https://jvzh.cn</a>功能机需要先用智能机或电脑通过上述域名登录后在个人页面获取用户名。之后功能机可以凭借获取登录填写的用户名和密码在<a href="http://wap.jvzh.cn">http://wap.jvzh.cn</a>域名登录。
</div></div></div>';
//echo'<center><div class="other"><form action="" method="POST">用户名:<br/>
//<input type="text" name="login" value=""><br/>
//密码:<br/>
//<input type="password" name="pass" value="">
//<br/><br/>
//<input type="submit" name="auth" value="登录"><br/></form></div> </center>';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>


