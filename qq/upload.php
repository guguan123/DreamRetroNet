<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';
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
//随机生成8位数字
        function nonceStr() {
            static $seed = array(0,1,2,3,4,5,6,7,8,9);
            $str = '';
            for($i=0;$i<8;$i++) {
                $rand = rand(0,count($seed)-1);
                $temp = $seed[$rand];
                $str .= $temp;
                unset($seed[$rand]);
                $seed = array_values($seed);
            }
            return $str;
        }
//echo nonceStr();
if(isset($_POST['add'])){
aut();
$nane = filtr($_POST['nane']);
if(mb_strlen($name) > '1' or mb_strlen($name) > '12') $err = '文字不少于1个或超过12个字符';
$text = filtr($_POST['text']);

if($err){ 
err($err);
}else{
$con->query("INSERT INTO `qun` (`qid`, `name`, `text`, `user_id`, `ip`, `time`) VALUES ('".nonceStr()."', '".$name."', '".$text."', '".$user['id']."', '".$ip."', '".time()."')");    
header('Location: ?');
}
}
echo '<h2 class="topic">创建群</h2>
	<form action="" method="post" enctype="multipart/form-data" class="form"><div>
	<label>群名：</label>
<input type="text" name="name" value="" >
</div><div>
<label>介绍：</label>
<input type="text" name="text" value="" /></div><div>
	<input type="submit" name="add" value="创建" /></div>
	</form></div>';