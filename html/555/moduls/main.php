<?php

$hot = $con->query("SELECT * FROM `file` WHERE `ivent` = 1 AND `downs` > 2 ORDER BY `downs` DESC LIMIT 12");


echo '<div class="chk_red">
<span class="title_chk_red">热门</span><div class="block">';
while($w = $hot->fetch_assoc()){

echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 下载: '.$w['downs'].' 次.</span></div></div></a></div>';

}
echo '</div></div>';
$new = $con->query("SELECT * FROM `file` WHERE `ivent` = 1 ORDER BY `id` DESC LIMIT 12");
echo '
<span class="title_chk_red">最新</span><div class="block">';

while($w = $new->fetch_assoc()){

echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 下载: '.$w['downs'].' 次.</span></div></div></a></div>';
}
echo'</div>';
$up = $con->query("SELECT * FROM `file` WHERE `ivent` = 1 ORDER BY `id` DESC LIMIT 12");
echo '
<span class="title_chk_red">推荐</span><div class="block">';
while($w = $up->fetch_assoc()){
echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 下载: '.$w['downs'].' 次.</span></div></div></a></div>';
}

echo '</div>';
?>