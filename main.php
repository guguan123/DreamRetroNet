<?php
include "M/c/function.php";
if(isset($_GET["local"])){
  $_SESSION["language"] = $_GET["local"];
}else{
  $_SESSION["language"] = getDefalutlanguage();
}
$language_name = getLanguageName($_SESSION["language"]);
if (!$language_name){
echo '<link rel="stylesheet" href="/M/c/notice.css">';
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>我们没有找到语言包</p></body>';
exit();
}else{
include "M/e/".$language_name.".inc";
}

  $language_array = array_language();
  foreach($language_array as $key => $value){
    if($_SESSION["language"] == $value){
      $selected = "selected = 'selected' ";
    }else{
      $selected = "";
    }
    }

  if($_GET["local"] == $value){
      //$selected = "selected = 'selected' ";
    }
   echo $header;
?>
<meta itemprop="name" content="<?php $title2 ?>" />

<?php
 echo '<title>'.$title2.'</title>';
echo '</head>';   
echo '<div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="'.$exit.'"></a>
';
echo '<h1>'.$title2.'</h1>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div id="nav" class="container"><a href="/">'.$zhuye.'</a><span>'.$zhuye.'</span></div>';
echo '<main class="container"><div id="main">';
//echo '<h2>'.$title2.'</h2><a href="/"><img src="/favicon.ico" width="32" height="32" alt="续梦网logo" /><h1>'.$title2.'</h1>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';

//echo '<div class="chk_red">
//<span class="title_chk_red">热门</span><div class="block">';


//while($w = $hot->fetch_assoc()){

//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img src="/icon/'.$w['id'].'" width="23" height="23" alt="图标" /> <div class="example_text">'.$w['name'].'<span><i class="fas fa-file-download ic"></i> 下载: '.$w['downs'].' 次.</span></div></div></a></div>';
//截图列表
//$ne = $con->query("select * from `file WHERE `ivent` = 1 order by rand() desc");
//$ne = $con->query("SELECT * FROM `file` WHERE `ivent` = 1 ORDER BY `id` DESC");
//echo '<h2 class="topic bg-white">推荐</h2>';
echo '<h2 class="topic bg-white">240×320</h2><div class="box">';
echo '<ul class="res">';
//$ms = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$mn['id']."' ORDER BY `id` ASC LIMIT 10")->
//fetch_assoc();
$mn = $con->query("SELECT * FROM `game` WHERE `dpi` = '240×320' and `img` = '有图' ORDER BY RAND() limit 12");

while($ms = $mn->fetch_assoc()){
//$ne = $con->query("SELECT * FROM `image` WHERE `id_game` = '".$ms['id']."' ORDER BY RAND() limit 1")->fetch_assoc();
$ne = $con->query("SELECT * FROM `image` WHERE `id_game` = '".$ms['id']."' ORDER BY `id` ASC limit 1")->fetch_assoc();
if ($ne['url']){
//
if($name = $ms['cn'] ?: $ms['name']){
echo '<li><a href="/game/'.$ms['id'].''.$local1.'"><img src="/M/s/'.$ne['url'].'" alt="'.$name.''.$covers240.'"></a>';
echo '<h3><a href="/game/'.$ms['id'].''.$local1.'">'.$name.'</a></h3></li>';
}
}
}
echo '</ul></div>';

echo '<h2 class="topic margin-top bg-white">320×240</h2><div class="box">';
echo '<ul class="res">';
//$ms = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$mn['id']."' ORDER BY `id` ASC LIMIT 10")->
//fetch_assoc();
$mns = $con->query("SELECT * FROM `game` WHERE`dpi` = '320×240' and `img` = '有图' ORDER BY RAND() limit 12");
while($mss = $mns->fetch_assoc()){
$nes = $con->query("SELECT * FROM `image` WHERE `id_game` = '".$mss['id']."' ORDER BY `id` ASC limit 1")->fetch_assoc();
if ($nes['url']){
//
if($name = $mss['cn'] ?: $mss['name']){
echo '<li><a href="/game/'.$mss['id'].''.$local1.'"><img src="/M/s/'.$nes['url'].'" alt="'.$name.''.$covers240.'"></a>';
echo '<h3><a href="/game/'.$mss['id'].''.$local1.'">'.$name.'</a></h3></li>';
}
}
}
echo '</ul></div>';

echo '<h2 class="topic margin-top bg-white">128×128</h2><div class="box">';
echo '<ul class="res">';
//$ms = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$mn['id']."' ORDER BY `id` ASC LIMIT 10")->
//fetch_assoc();
$mnss = $con->query("SELECT * FROM `game` WHERE`dpi` = '128×128' and `img` = '有图' ORDER BY RAND() limit 12");
while($msss = $mnss->fetch_assoc()){
$ness = $con->query("SELECT * FROM `image` WHERE `id_game` = '".$msss['id']."' ORDER BY `id` ASC limit 1")->fetch_assoc();
if ($ness['url']){
//
if($name = $msss['cn'] ?: $msss['name']){
echo '<li><a href="/game/'.$msss['id'].''.$local1.'"><img src="/M/s/'.$ness['url'].'" alt="'.$name.''.$covers240.'"></a>';
echo '<h3><a href="/game/'.$mss['id'].''.$local1.'">'.$name.'</a></h3></li>';
}
}
}
echo '</ul></div>';
//}
//截图列表结束
//$comment = $con->query("SELECT * FROM `comment` WHERE `id_obmen` ='{$file['id']}' ORDER BY `id` DESC LIMIT 5");
//while($comm = $comment->fetch_assoc()){
//评论
//$com = $con->query("SELECT * FROM `comment` ORDER BY `id` DESC LIMIT 10");

echo '<h2 class="topic margin-top">'.$comments.'</h2><ul data-url="/comments?pagesize=10'.$local2.'" data-tpl="commentlist" class="list comment line padding bg-white" id="comment"></ul></div>';


//$ms = $con->query("SELECT * FROM `user` ORDER BY `id` DESC LIMIT $start, 10");
//while($w = $ms->fetch_assoc()){

$users = $con->query("SELECT * FROM `user` ORDER BY `id` DESC");
echo '<div id="aside"><h2 class="topic margin-top bg-white"><a href="/login" class="right">'.$login_name.'</a>'.$users->num_rows.''.$userss.'</h2>
<div class="faces bg-white" data-url="/users?pagesize=30" data-tpl="facewall"></div>';

echo '<h2 class="topic margin-top bg-white"><a href="/games/upload" class="right">'.$update.'</a><a href="/games?order=10">'.$orders.'</a></h2><ul class="list icon small line1 bg-white" data-url="/games?order=10&pagesize=10'.$local2.'" data-tpl="gamesimple"></ul>';

echo '<h2 class="topic margin-top bg-white"><a href="/games'.$local1.'">'.$tops.'</a></h2><ul class="list icon small line1 bg-white" data-url="/games?top=10&amp;pagesize=10'.$local2.'" data-tpl="gamesimple"></ul></div></main>';


//echo '
//<span class="title_chk_red">最新</span><div class="block">';
//while($w = $new->fetch_assoc()){

//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 下载: '.$w['downs'].' 次.</span></div></div></a></div>';
//}
//echo'</div>';
//$up = $con->query("SELECT * FROM `file` WHERE `ivent` = 1 ORDER BY `id` DESC LIMIT 12");
//echo '
//<span class="title_chk_red">推荐</span><div class="block">';
//while($w = $up->fetch_assoc()){
//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 下载: '.$w['downs'].' 次.</span></div></div></a></div>';
//}

//echo '</div></main>';
?>