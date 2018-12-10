<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Top</title>

    <link rel="stylesheet" href="../style/admin.css">
</head>
<body id="top">

    <h1>LOGO</h1>

    <ul>
        <li><a id="nav1" name="admin_nav" target="sidebar" href="sidebar.php" class="selected" onclick="admin_top_nav(event)">首页</a></li>
        <li><a id="nav2" name="admin_nav" target="sidebar" href="sidebarn.php" onclick="admin_top_nav(event)">内容</a></li>
        <li><a id="nav3" name="admin_nav" target="sidebar" href="###" onclick="admin_top_nav(event)">会员</a></li>
        <li><a id="nav4" name="admin_nav" target="sidebar" href="###" onclick="admin_top_nav(event)">系统</a></li>
    </ul>

    <p>
        您好，<strong>admin</strong>【超级管理员】【<a href="../" target="_blank">去首页</a>】【退出】
    </p>

</body>

<script type="text/javascript" src="../js/admin_top_nav.js"></script>
</html>