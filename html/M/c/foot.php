<?php

$end_time = microtime();

$end_array = explode(" ", $end_time);

$end_time = $end_array[1] + $end_array[0];

$time = $end_time - $start_time;

echo '<script src="/static/jquery.min.js"></script><script src="/static/webset.js"></script><script src="/static/rmct.cn.js"></script><script src="/static/jquery.js"></script></script><script type="text/javascript" src="/static/script.js"></script>';
echo '<footer>&copy; 2016-';
echo date('Y');
echo '<a href="//icp.gov.moe/?keyword=20240183">萌ICP备20240183号</a>
<a href="//nyaicp.xyz/?id=20240009" target="_blank">喵ICP备20240009号</a>
<a href="//guan.ma/hao/2024000140/" title="官码2024000140号">官ICP备2024000140号</a>
<!-- 底部运行天数 -->
<script>
	//页面加载完执行下方函数
	share_data_time();
	function share_data_time() {
		//每秒执行一次
	   window.setTimeout("share_data_time()", 1000);
	    //网站建立时间
	    BirthDay = new Date("11/11/2017 13:19:21");
	    //获取当前时间
	    today = new Date();
	    //总豪秒数
	    timeold = (today.getTime() - BirthDay.getTime());
	    //总秒数
	    secondsold = Math.floor(timeold / 1000);
	    e_daysold = timeold / (24 * 60 * 60 * 1000);
	    //相差天数
	    daysold = Math.floor(e_daysold);
	    e_hrsold = (e_daysold - daysold) * 24;
	    //相差小时数
	    hrsold = Math.floor(e_hrsold);
	    e_minsold = (e_hrsold - hrsold) * 60;
	    //相差分钟数
	    minsold= Math.floor(e_minsold);
	    //相差秒数
	    seconds = Math.floor((e_minsold - minsold) * 60);
	    //将所获取的时间拼接到一起，再把值显示到页面
	    share_time.innerHTML = "本站已安全运行:" + daysold + "天";
// + hrsold + "小时" + minsold + "分" + seconds + "秒";
	}
 </script>
<br><span id="share_time" style="color: #E9C2A6; font-weight: bold;"></span>

<script id="LA-DATA-WIDGET" crossorigin="anonymous" charset="UTF-8" src="https://v6-widget.51.la/v6/K3pGGiqjftaNJR8a/quote.js?theme=0&f=12&display=0,1,1,1,1,1,1,1"></script>
    <a href="http://wapmz.com/in/118"><img src="http://wapmz.com/cn/big/118" alt="wapmz.com"></a>
<br><a href="/info/1">负责声明</a><a href="/info/2">联系我们</a><a href="/info/3">捐助我们</a><a href="/info/4">常见问题</a><a href="/link">友情链接</a><a href="//iniche.cn/static/JL-Iniche-ver.221006.2130-release.apk">安卓模拟器</a>';
echo '</footer>';
//echo '</div></div></div>';
//echo '</div></div></div>';
//</div>
//</div>
//</div>
//<div class="bottom">
//    <div id="body">java游戏<a href="/">乐园</a> 2019</div>
//</div>';
?>

<script>
        $(".open_btn").click(function(){
            if($(this).hasClass("active")){
                $(".txtcont").removeClass("active");
                $(this).removeClass("active").text('展开');
            }else{
                $(".txtcont").addClass("active");
                $(this).addClass("active").text('收起');
            }
        })
    </script>
