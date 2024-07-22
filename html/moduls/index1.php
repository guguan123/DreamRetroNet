<?php

$hot = $con->query("SELECT * FROM `file` WHERE `downs` > 2 ORDER BY `downs` DESC LIMIT 10");



echo '<h2 class="topic margin-top bg-white"><a href="/games">TOP10</a></h2><ul class="list icon small line bg-white"><li>';
while($w
echo '<a href="file/'.$w['id'].'"><img src="/icon/'.$w['id'].'" width="23" height="23" alt="图标" />'.$w['name'].'</a>';
echo '</li><li>';
}

echo '<div class="chk_red">
<span class="title_chk_red">热门</span>';
while($w = $hot->fetch_assoc()){
$mss = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$w['id']."' ORDER BY `id` ASC LIMIT 1");
while($ww = $mss->fetch_assoc()){

echo '<a href="file/'.$w['id'].'"><img src="/down/images/'.$ww['url'].'" width="23" height="23" alt="图标" />'.$w['name'].'</a>';
echo '</li><li>';
echo '<div class="carousel-cell"><a href="/file/'.$w['id'].'"><div class="example3"> 
<img class="img_rms" src="/down/images/'.$ww['url'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 下载: '.$w['downs'].' 次.</span></div></div></a></div>';
}
}
echo '</div>';
$new = $con->query("SELECT * FROM `file` ORDER BY `id` DESC LIMIT 10");
echo '<div class="chk_red">
<span class="title_chk_red">最新</span>';

while($w = $new->fetch_assoc()){
$mss = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$w['id']."' ORDER BY `id` ASC LIMIT 1");
while($ww = $mss->fetch_assoc()){

echo '<div class="carousel-cell"><a href="/file/'.$w['id'].'"><div class="example3">
 <img class="img_rms" src="/down/images/'.$ww['url'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 下载: '.$w['downs'].' 次.</span></div></div></a></div>';
}
}
echo'</div>';
$up = $con->query("SELECT * FROM `file` ORDER BY `id` DESC LIMIT 10");
echo '<div class="chk_red">
<span class="title_chk_red">推荐</span>';
while($w = $up->fetch_assoc()){
$mss = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$w['id']."' ORDER BY `id` ASC LIMIT 1");
while($ww = $mss->fetch_assoc()){

echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
<img class="img_rms" src="/down/images/'.$ww['url'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 下载: '.$w['downs'].' 次.</span></div></div></a></div>';
}
}
echo '</div>';
?>