<?php
//include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/menu.php';

//echo '<p>珍藏即将遗失的功能机JAVA游戏软件</p></a>';
echo '<ul id="user">';					
if(!$user){
      
echo '<a href="/login'.$local1.'"><img class="Avatar" src="/M/guest.png" width="32" height="32" alt="头像" /><span>'.$login.'</span></a>';
}else{
if($user['qq_avatar']){
$user_qq = ''.$user['qq_avatar'].'&s=40&t='.$user['up_time'].'';
}
if($user['baidu_avatar']){
$user_baidu = 'https://himg.bdimg.com/sys/portrait/item/'.$user['baidu_avatar'].'';
}

if ($avatar = $user_qq ?: $user_baidu){
echo '<a href="/user/'.$user['id'].''.$local1.'"><img class="Avatar" src="'.$avatar.'" width="32" height="32" alt="头像" />';
}							
if($user_name = $user['name'] ?: $user['login']){
echo '<span>'.$user_name.'</span></a>';
}
//if ($user['v']>=1){
//echo '<i class="m-icon m-icon-user m-icon-yellowv"></i></span1>';
//<img  class="Avatar v" src="/style/image/V.png" width="14" height="14" alt="头像" />
//}
//echo '</a>';
}
echo '</ul></div>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/menu.php';
//include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/language.php';
?>