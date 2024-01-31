<?php

echo '<ul id="user">';

if(!$user){
echo '<a href="/auth"><img class="Avatar" src="/style/image/index/user.png" width="32" height="32" alt="头像" /><span>登录</span></a></ul></div>';
}else{
if ($user['qq']){
echo '<a href="/user"><span1 class="user-img"><img class="Avatar" src="http://thirdqq.qlogo.cn/g?b=oidb&amp;nk='.$user['qq'].'&amp;s=40&amp;t='.$user['time'].'" width="32" height="32" alt="头像" />';
}
if ($user['baidu_pic']){
echo '<a href="/user"><span1 class="user-img"><img class="Avatar" src="http://tb.himg.baidu.com/sys/portraitn/item/'.$user['baidu_pic'].'" width="32" height="32" alt="头像">';
}
if ($user['v']>=1){
echo '<i class="m-icon m-icon-user m-icon-yellowv"></i></span1>';
//<img  class="Avatar v" src="/style/image/V.png" width="14" height="14" alt="头像" />
}
echo '<span>'.$user['name'].'</span></a>';
echo '</ul></div>';
}
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/menu.php';
?>