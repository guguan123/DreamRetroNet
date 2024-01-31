<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/menu.php';
//echo '<p>珍藏即将遗失的功能机JAVA游戏软件</p></a><ul><li><a href="/" class="iconfont icon-zhuye">首页</a></li><li><a href="/games" class="iconfont icon-yingyong">应用</a></li><li><a href="/search" class="iconfont icon-sousuo">搜索</a></li><li><a href="/info/3" class="iconfont icon-juanzeng">捐助</a></li></ul>';
//echo '<ul id="user">';
if(!$user){
echo '<a href="/login"><img class="Avatar" src="/M/guest.png" width="32" height="32" alt="头像" /><span>登录</span></a>';
}else{
if($user['qq']){
$qq = ''.$user['avatar'].'&s=40&t='.$user['data_reg'].'';
}
if($user['baidu']){
$baidu = 'https://himg.bdimg.com/sys/portraitn/item/'.$user['avatar'].'';
}
echo '<a href="/user/'.$user['id'].'"><span1 class="user-img">';
//$avatar = ''.$qq.'';
if ($avatar = $qq ?: $baidu){
echo '<img class="Avatar" src="'.$avatar.'" width="32" height="32" alt="头像" />';
}else{
echo '<img class="Avatar" src="/M/guest.png" width="32" height="32" alt="头像" />';
}
if ($user['v']>=1){
echo '<i class="m-icon m-icon-user m-icon-yellowv"></i></span1>';
//<img  class="Avatar v" src="/style/image/V.png" width="14" height="14" alt="头像" />
}
if($name = $user['name'] ?: $user['login']){
echo '<span>'.$name.'</span></a>';
}
//echo '</a>';
}
echo '</header>';
//include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/language.php';
?>