<?php
echo '</head><body>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<br><a href="#">设置机型</a> <a href="#">书签</a>
<br><img src="/image/wap-logo.png">
<br><img src="#">免费下载区
<br><a href="/soft">全部</a> <a href="/symbian.html">塞班</a> <a href="java.html">Java</a> <a href="/mrp.html">MRP</a> <a href="/search">搜索</a>';
$page = 1;
if(isset($_GET['page']))
$page = $_GET['page'];
$k_post = $con->query("SELECT * FROM `game`")->num_rows;
$total = $k_post;//记录数
$count = 0;
$pagesize = 10;
$totalPage = ceil($total/$pagesize);//总页数
$pages = ceil($conut/$pagesize);//共多少页
$prepage=$page-1;
if($prepage<=0)
$prepage=1;
$nextpage = $page+1;
if($nextpage >= $pages){
$nextpage = $pages;
$start = ($page-1) * $pagesize;
}
$new = $con->query("SELECT * FROM `game` ORDER BY `id` DESC LIMIT $start,$pagesize");
while($w = $new->fetch_assoc()){
echo '<br><a href="/soft/'.$w['id'].'.html"><img src="//image.baorua.cn/i/'.$w['icon'].'" >';
if($name = $w['cn'] ?: $w['name']){
echo ''.$name.'</a>';
}
$size = getsize(''.$w['size'].'');
$str=$w['format'];
$str=str_replace('.','',$str);
echo '('.$size.'/'.$str.')';
}
//echo '</ul>';
while($count < 1){
echo '<br>第'.$page.'页/共'.$totalPage.'页 | <a href="/soft/2">下一页</a>';
$count++;
}

?>