<?php

$end_time = microtime();

$end_array = explode(" ", $end_time);

$end_time = $end_array[1] + $end_array[0];

$time = $end_time - $start_time;

echo '<div id="footer" class="margin-top"><div><a href="/info/1">免责声明</a> | <a href="/info/2">联系我们</a> | <a href="/info/3">关于我们</a> | <a href="/info/4">常见问题</a>
</div>
<div>&copy; 2017-';
echo date('Y');
echo ' rmct.cn <a href="http://wapmz.com/in/119"><img src="http://wapmz.com/cn/big/119" alt="wapmz.com"></a></div></div></body></html>';
//echo '</div>
//</div>
//</div>
//</div>
//<div class="bottom">
//    <div id="body">java游戏<a href="/">乐园</a> 2019</div>
//</div>';
?>
