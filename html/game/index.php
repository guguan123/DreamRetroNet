<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

$bx = $con->query("SELECT * FROM `game` WHERE `id` = '".$id."'")->fetch_assoc();
if($bx){
if($name = $bx['cn'] ?: $bx['name']){
$title = ''.$name.'';
}
}
 echo '<title>'.$title.'  - 续梦网</title>';
//echo '<h1>'.$title.'</h1>';

include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
//echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui" title="返回"></a>';
//

echo '</header><div id="where"><a href="/">首页</a><a href="/games">列表</a>';
if($name = $bx['cn'] ?: $bx['name']){
echo ''.$name.'</div>';
}
echo '<div id="middle"><div id="main">';

$b = $con->query("SELECT * FROM `game` WHERE `id` = '".$id."'")->fetch_assoc();
//$g = $con->query("SELECT * FROM `games` WHERE `id` = '".$id."'")->
//fetch_assoc();

if($b){
if($b['id'] ->num_rows >0){
 echo '<body id="notice"><h2 class="topic">消息提示</h2><p>你防问的游戏不存在</p>';
echo '</p><p><a href="#back" class="button">返回</a></p>';
  exit;
}
$title = ''.$b['name'].'';

$size = getFilesize($_SERVER['DOCUMENT_ROOT'].'/download/'.$b['down'].'');
$size2 = getFilesizes($_SERVER['DOCUMENT_ROOT'].'/download/'.$b['down'].'');
//echo '<div class="block"><div class="b_flex_down_l"><h1>'.$b['name'].'</h1>'; $msssa = $con->query("SELECT * FROM `class` WHERE `id` = '".$b['id_raz']."'"); while($wss = $msssa->fetch_assoc()){echo '<h2>'.$wss['name'].'</h2>';} echo '</div><div class="b_flex_down_r"><a href="/download/'.$b['id'].'"><button class="down">下载</button></a></div></div>';

//$ms = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$b['id']."' ORDER BY `id` ASC LIMIT 10");
//if($ms){
//echo "还没有游戏截图！";
//}else{
//while($w = $ms->fetch_assoc()){
//echo '<div class="carousel-cell"><img class="img_rms" src="/down/images/'.$w['url'].'"></div>';
//}
//}

$s = $con->query('SELECT * FROM `image` WHERE `id_game` = "'.$id.'"')->fetch_assoc();
$u = $con->query('SELECT * FROM `user` WHERE `id` = "'.$b['id_user'].'"')->fetch_assoc();
if($s['background']==1){
echo '<div class="game" style="background-image: url(/M/s/'.$s['url'].')" ><div><img src="/M/i/'.$b['icon'].'" width="46" height="46" alt="图标" /><div>';
}else{

//echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a><h1>'.$b['name'].'</h1>';
if($name = $b['cn'] ?: $b['name']){
echo '<div class="post-body">
				<h1 class="post-title">'.$name.'</h1>';
}
echo '<table>
  <tbody>
    <tr>
      <td>';
if($s['id_game']==$b['id']){
      echo '<img src="/jietu/'.$s['id'].'" ></a>';
      }else{
      echo '<img src="/jietu/0" ></a>';
      }
      
      echo '</td>
      <td>厂商：<a href="/games?vendor='.$b['author'].'">'.$b['author'].'</a><br>分类：<a href="/games?category='.$b['raz'].'">'.$b['raz'].'</a><br>平台：<a href="/games?system='.$b['platform'].'">'.$b['platform'].'</a><br>语言：<a href="/games?lang='.$b['zh'].'">'.$b['zh'].'</a><br>大小：'.$size.'</br>版本：'.$b['v'].'<br>下载：'.$b['downs'].'</br>';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
echo '评论：'.$number.'</br>分辨率：<a href="/games?resolution='.$b['dpi'].'">'.$b['dpi'].'</a></br>单机联机：<a href="/games?online='.$b['DJ'].'">'.$b['DJ'].'</a>
 </td>
    </tr></tbody>
</table>';
//echo '<div class="info-wrap bg-white"><div class="info"> <span class="info-img"><a href="/game/'.$b['id'].'"><img src="/M/i/'.$b['icon'].'" width="46" height="46" alt="'.$icons.'" /></a></span>';
}

//echo '<p class="tip">感谢<a href="/games?users_id='.$b['id_user'].'">'.$u['name'].'</a>提供安装包</p><div class="info-btn">';
echo '</div>';

//echo ''.$number.''.$number_num.'&nbsp;<a href="/feedbacks/add?games_id=14184'.$local2.'">举报</a></div></div></div>';
if($text = $b['text'] ?: $b['name']){
echo '<div class="basebox">
<div class="txtwrap">
<div class="txtcont"><p>'.$text.'</p></div>
<div class="txt_foot">
    <div class="open_btn">展开</div>
</div>
</div>
</div>';
}
if($b['format']=='.mrp'){
$name = $b['cn'] ?: $b['name'];
echo '<div class="download res2"><a rel="nofollow" href="/vmrp/?f=https://jvzh.org/package/'.$b['id'].''.$b['format'].'&title='.$name.'">在线打开</a><a href="/package/'.$b['id'].''.$b['format'].'">下载安装包</a></div>';
}else{
echo '<div class="download"><a href="/package/'.$b['id'].''.$b['format'].'">下载安装包</a></div>';
}
echo '<p class="tip">感谢<a href="/games?users_id='.$b['id_user'].'">'.$u['name'].'</a>提供安装包</p>';
$mu = $con->query("SELECT * FROM `image` WHERE `id_game` = '".$b['id']."' ORDER BY `id` ASC");

echo '<div id="screens" class="margin-top">';
while($ms = $mu->fetch_assoc()){
//data-url="/screens/'.$b['id'].'" data-tpl="screenlist" 
echo '<a href="/jietu/'.$ms['id'].'" data-lightbox="lightbox"><img src="/jietu/'.$ms['id'].'"></a>';
}
echo'</div></div>';
echo '<div id="aside">';
echo '<div class="box"><h2 class="topic">';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
if ($number){
echo '<a href="/comments/'.$b['id'].'" class="right">查看'.$number.'条</a>';
}
echo '观点</h2>';
if($user){

echo '<form class="form bg-white" action="/comments/'.$b['id'].'" method="post"><div><textarea rows="5" cols="30" name="text" placeholder="这里填写内容......"></textarea></div><div><input type="submit" name="add" value="提交" /></div></form>';
}

echo '<ul class="list comment line padding bg-white" id="comment" data-url="/comments?games='.$b['id'].'" data-tpl="commentlist"></ul></div>';
//($number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
//echo '<div class="margin_site_title_file"><span class="title"><a href="/comment/'.$b['id'].'">评论</a>'.$number.'</span></div>';

echo '<div class="box">';
//echo '<div class="margin_site_title_file"><span class="title">类似的游戏</span></div><div class="block">';

echo '<h2 class="topic"><a href="/games?vendor='.$b['author'].'">同厂</a></h2>';

echo '<ul class="list" data-url="/games?vendor='.$b['author'].'&order=rnd&pagesize=10" data-tpl="gamesimple"></ul>';

}
echo '</div>';
if($user['id']==$b['id_user'] ?: $user['admin_level']>="管理员"){

echo '<ul class="list icon small line bg-white margin-top"><li><a href="/game/edit/'.$b['id'].'">编辑</a></li></ul>';
echo'</div>';
}
echo'</div></div>';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>