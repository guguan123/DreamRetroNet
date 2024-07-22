<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';

$title = '手机JAVA游戏商店';

include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

$b = $con->query("SELECT * FROM `class`");
$ab = $con->query("SELECT * FROM `class`")->fetch_assoc();
if(!$ab) err('这里啥也没有');

echo '<div class="menu_link">';

while($w = $b->fetch_assoc()){
echo '<a href="/class/'.$w['id'].'"><i class="fas fa-puzzle-piece ic"></i> '.$w['name'].' <span class="c_link">
'.$con->query('SELECT * FROM `file` WHERE `id_raz` = "'.$w['id'].'"')->num_rows.'</span></a>';
if($user['admin_level']>=2){
echo '<a href="/class_edit/'.$w['id'].'">[编辑]</a> <a href="/class_del/'.$w['id'].'">[删除]</a>';
}
}

echo '</div>';

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>