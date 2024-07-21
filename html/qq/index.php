<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/system/base.php';
echo '<h1>续聊</h1>';
echo '<div>列表</div>';
echo '<li><a href="#">待申请</a></li>';
echo '<li><a href="/chat">公共聊天室</a></li>';
echo '<div>群聊</div>';

$ms = $con->query("SELECT * FROM `qun` WHERE `id` ORDER BY `id` DESC");
echo '<ul class="list comment line padding bg-white" id="comment">';
while($w = $ms->fetch_assoc()){
echo '<li><a href="/qq?qid='.$w['qid'].'">'.$w['name'].'</a></li>';
if ($qid==$w['qid']){
qu($w['qid']);
}
}
echo'<li><a href="/qq/search">搜索群</a></li>';
echo'<li><a href="/qq/upload">创建群</a></li></ul>';
echo '<div>好友</div>';

echo '<li><a href="#">增加好友</a></li>';