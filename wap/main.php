<?php
echo '<div class="header"><a href="/">'.$title2.'</a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/wap/M/c/user.php';
echo '<div class="wrapper"><form action="/search" method="post"><input type="search" name="keyword" value="" /><input type="submit" value="搜索" /></form>';

$new = $con->query("SELECT * FROM `game` ORDER BY `id` DESC LIMIT 20");
while($w = $new->fetch_assoc()){
echo ' <ul><li><a href="/game/'.$w['id'].'"><img src="/M/i/'.$w['icon'].'" width="24" height="24" alt="图标" />';
if($name = $w['cn'] ?: $w['name']){
echo ''.$name.'</a>';
}
echo '</li>';
}
echo '</ul>';
echo '<div><a href="/games">查看全部游戏……</a></div></div>';

?>