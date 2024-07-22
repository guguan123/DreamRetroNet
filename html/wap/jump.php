<?php
$q = abs(intval($_GET['q'])); # ФИЛЬТР ГЕТ
$system = filter_var($_GET['system']);

if($system == "game"){
echo '<meta http-equiv="refresh" content="0;url=http://wap.rmct.cn/game/'.$q.'">';
echo '<title></title>
</head>
<body>正在跳转中<br>
<a href="/game/'.$q.'">如等待时间过长可点击这里跳转</a>

</body></html>';
}
if($system == "iniche"){
echo '<meta http-equiv="refresh" content="0;url=http://wap.iniche.cn/game/'.$q.'">';
echo '<title></title>
</head>
<body>正在跳转中<br>
<a href="//wap.iniche.cn/game/'.$q.'">如等待时间过长可点击这里跳转</a>

</body></html>';
}
if($system == "jvgm"){
echo '<meta http-equiv="refresh" content="0;url=http://jvgm.cn/file/'.$q.'.html">';
echo '<title></title>
</head>
<body>正在跳转中<br>
<a href="//jvgm.cn/file/'.$q.'.html">如等待时间过长可点击这里跳转</a>

</body></html>';
}
