<?php
/**
 * Created by PhpStorm.
 * User: tao
 * Date: 2016-09-13
 * Time: 20:50
 */

session_start();
require_once '../baidu/config.php';
require_once '../baidu/dohttps.php';
$code = $_GET['code'];
if($code){
    $getaccesstoken_url = "https://openapi.baidu.com/oauth/2.0/token?grant_type=authorization_code&code=$code&client_id=$api_key&client_secret=$serect_key&redirect_uri=$redirect_url";
    $httpsobj = new doHttps();
    $https_res = $httpsobj->getdata($getaccesstoken_url);
    $accesstoken = $https_res['access_token'];
    $userinfo_url = $apibase_url.'passport/users/getLoggedInUser'.'?access_token='.$accesstoken;
    $user_res = $httpsobj->getdata($userinfo_url);
    $smallpic = $user_res['portrait'];
    $nickname = $user_res['uname'];
    $baidu_id = $user_res['openid'];
    $_SESSION['accesstoken'] = $accesstoken;
    $_SESSION['nickname'] = $nickname;
    $_SESSION['smallpic'] = $smallpic;
    $_SESSION['baidu_id'] = $baidu_id;
}else{
    echo "<javascript>alert('授权失败')</javascript>";
}
//header("Location: ".'index.php');


        
?>


<?php
session_start();
require_once '../baidu/config.php';
$accesstoken = $_SESSION['accesstoken'];
$logout_url = "https://openapi.baidu.com/connect/2.0/logout?access_token=$accesstoken&next=$logout";

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>index</title>
</head>
<body>
welcome```````
<hr>
<?php echo $_SESSION['nickname'] ?>
<?php echo $_SESSION['baidu_id'] ?>
<hr>
<img src=" http://tb.himg.baidu.com/sys/portraitn/item/<?php echo $_SESSION['smallpic']?>" alt="">
<hr>
<a href="logout.php">loginout</a>
</body>

</html>

<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '修改昵称';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

if(isset($_POST['submit'])){

$name = $_POST['name'];
$pass2 = filtr($_POST['pass2']);
$pass = filtr($_POST['pass']);
if($pass != $pass2) $err = '两次密码不同';
if(mb_strlen($pass) < '4')  $err = '密码长度大于4';


//$ms = $con->query("SELECT * FROM `user` WHERE `id` = '".$user['id']."'")->fetch_assoc();

$con->query("UPDATE `user` SET `pass` = '".$pass."' WHERE `baidu_id` = '".$_SESSION['baidu_id']."'");


}else{
echo '<center><div class="other"><form action="" method="POST">
<form method="post" action="yanzhen.php">
 <br><br>
    <input type="text" name="YanEmail" placeholder="请输入验证吗">  //此处为用户输入的验证码
    <input type="hidden" name="yanzhen" value="<?php echo $yanzhen;?>" >
    <br/>
昵称:<br/>
<input type="text" name="name" value="'.$user['name'].'"><br/>

<br/>
<input type="submit" name="submit" value="修改"><br/></form></div> </center>';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>
<form method="post" action="../../system/yanzhen.php">
    <span><?php echo $Email;?></span></br>  //此处的$Email为接收用户的邮箱（这儿看自己需求，可以是数据库查询，也可以是手动输入，只需要最后赋值给$Email即可）
    <span class="error"><?php include '../../system/email.php';?></span>  //此处为导入email.php文件，自动向用户发送验证邮箱
    <br><br>
    <input type="text" name="YanEmail" placeholder="请输入验证吗">  //此处为用户输入的验证码
    <input type="hidden" name="yanzhen" value="<?php echo $yanzhen;?>" >  //此处为系统向用户发送的验证码（注意：这样写对系统不安全，按照自己需求更改吧），
    <input type="submit" name="submit" value="验证">
