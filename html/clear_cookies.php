<?php
if (isset($_GET['deleteRemainingCookies']) && $_GET['deleteRemainingCookies'] === 'true') {
	// 清除所有cookie
	if (isset($_SERVER['HTTP_COOKIE'])) {
		$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		foreach($cookies as $cookie) {
			$parts = explode('=', $cookie);
			$name = trim($parts[0]);
			setcookie($name, '', time() - 3600, '/');
			//setcookie($name, '', time() - 3600, '/', $_SERVER['HTTP_HOST'], true, true); // Secure and HttpOnly flag
		}
	}
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>清除Cookie</title>
</head>
<body>
	<h1>清除Cookie示例</h1>
	<form method="get">
		<input type="hidden" name="deleteRemainingCookies" value="true">
		<button type="submit">清除所有Cookie</button>
	</form>
	<p id="message"></p>
	<script>
		// JavaScript检测cookie是否已被删除
		function checkCookies() {
			if (document.cookie === "") {
				document.getElementById('message').textContent = '所有可清除的cookie已被删除（JavaScript）。';
			} else {
				document.getElementById('message').textContent = '检测到未删除的cookie，尝试删除...';
				deleteRemainingCookies();
			}
		}

		// JavaScript删除剩余cookie
		function deleteRemainingCookies() {
			let cookies = document.cookie.split("; ");
			for (let i = 0; i < cookies.length; i++) {
				let cookie = cookies[i];
				let eqPos = cookie.indexOf("=");
				let name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
				document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
			}
			setTimeout(checkCookiesAgain, 1000); // 等待1秒再次检查
		}

		// 再次检查cookie状态
		function checkCookiesAgain() {
			if (document.cookie === "") {
				document.getElementById('message').textContent = '所有可清除的cookie已被删除。';
			} else {
				document.getElementById('message').textContent = '部分cookie无法删除，请手动删除。';
			}
		}

		// 页面加载后执行检查
		window.onload = function() {
			if (window.location.search.includes('deleteRemainingCookies=true')) {
				checkCookies();
				window.history.replaceState({}, document.title, window.location.pathname);
			}
		}
	</script>
	<style>
		@media (prefers-color-scheme: dark) {
			body {
				background-color: #121212;
				color: #fff;
				opacity: 0.87; /* 设置字体透明度为87%以增加可读性 */
			}
		}
	</style>
</body>
</html>
