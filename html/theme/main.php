<?php
echo '<div class="header"><a href="/">'.$title2.'</a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div class="wrapper"><form action="/search" method="post"><input type="search" name="keyword" value="" /><input type="submit" value="搜索" /></form><ul>';

$new = $con->query("SELECT * FROM `theme` ORDER BY `id` DESC LIMIT 20");
while($w = $new->fetch_assoc()){
echo '<li><a href="/theme/'.$w['id'].'"><img src="/M/i/'.$w['icon'].'" width="24" height="24" alt="图标" />'.$w['name'].'</a>';
echo '</li>';
}
echo '</ul>';
echo '<div><a href="/themes">查看全部主题……</a></div></div>';

?>