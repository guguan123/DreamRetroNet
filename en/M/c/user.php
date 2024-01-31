<?php

echo '<p>Treasure the soon-to-be-lost feature machine JAVA game software</p></a><ul><li><a href="/" class="iconfont icon-zhuye">Home</a></li><li><a href="/games" class="iconfont icon-yingyong">APP</a></li><li><a href="/search" class="iconfont icon-sousuo">search</a></li><li><a href="/info/3" class="iconfont icon-juanzeng">捐助</a></li></ul>';

if(!$user){
echo '<a href="/login"><img src="/M/guest.png" width="32" height="32" alt="头像" /><span>Log in</span></a>';
}else{
echo '<a href="/user/'.$user['id'].'"><span1 class="user-img">';
if ($user['avatar']){
echo '<img src="'.$user['avatar'].'" width="32" height="32" alt="头像" />';
}else{
echo '<img src="/M/guest.png" width="32" height="32" alt="头像" />';
}
if ($user['v']>=1){
echo '<i class="m-icon m-icon-user m-icon-yellowv"></i></span1>';
//<img  class="Avatar v" src="/style/image/V.png" width="14" height="14" alt="头像" />
}
if($name = $user['name'] ?: $user['login']){
echo '<span>'.$name.'</span></a>';
}

}
echo '</header>';
//include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/menu.php';
?>
<ul id="lang-slct" class="prd-ln" >
<div id="line1"/><a href="#" onclick="toggle_visibility('sblng');"><span class="line1"></span></a></div>
<div id="sblng" class="sblng" style="display: none;"><span id= "sblngs" class="sblngs">
<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/language.php';
?>
<script type="text/javascript">
function toggle_visibility(sblngs) {var e = document.getElementById(sblngs);
e.style.display = ((e.style.display!='none') ? 'none' : 'block');
}
</script>
