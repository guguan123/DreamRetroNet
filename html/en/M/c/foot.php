<?php

$end_time = microtime();

$end_array = explode(" ", $end_time);

$end_time = $end_array[1] + $end_array[0];

$time = $end_time - $start_time;
echo '<footer id="footer" class="container margin-top"><div><a href="/info/1">Disclaimer</a><a href="/info/2">contact us</a><a href="/info/3">捐助网站</a><a href="/info/4">common problem</a></div><div>&copy; 2016-';
echo date('Y');
echo ' jvzh.cn <a href="https://beian.miit.gov.cn/">	滇ICP备2021002463号-2</a><a href="http://wapmz.com/in/7"><img src="http://wapmz.com/cn/small/7" alt="wapmz.com"></a></div></footer><script src="//at.alicdn.com/t/font_3171365_hasz5h98gx.js"></script><script src="/M/j/en.jvzh.cn.js"></script></body></html>';
//echo '</div>
//</div>
//</div>
//</div>
//<div class="bottom">
//    <div id="body">java游戏<a href="/">乐园</a> 2019</div>
//</div>';
?>

