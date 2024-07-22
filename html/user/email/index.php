<?php
echo '<!DOCTYPE html>
<html>
<head>
    <title>邮箱绑定</title>
    <!-- 加载Bootstrap的CSS文件 -->
    <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>邮箱绑定</h2>
        <form action="code.php" method="post">
            <div class="form-group">
                <label for="email">邮箱地址</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="请输入邮箱地址">
            </div>
            <button type="submit" class="btn btn-primary">发送验证码</button>
        </form>
    </div>

    <!-- 加载Bootstrap的JS文件 -->
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.bootcdn.net/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>';