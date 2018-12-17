<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录CMS后台管理系统</title>

    <link rel="stylesheet" href="../style/admin.css">
    <script type="text/javascript" src="../js/admin_login.js"></script>
</head>
<body>

<form id="adminLogin" name="adminLogin" action="?action=login" method="post">
    <fieldset>
        <legend>登录CMS后台管理系统</legend>
        <label for="">账　号：<input type="text" name="admin_user" class="text"></label>
        <label for="">密　码：<input type="password" name="admin_pass" class="text"></label>
        <label for="">验证码：<input type="text" name="code" class="text"></label>
        <label for="" class="t">输入下面的字符，不区分大小写</label>
        <label for=""><img src="../config/code.php" alt="" onclick="javascript:this.src='../config/code.php?tm='+Math.random();"></label>
        <input type="submit" value="登录" class="submit" onclick="return checkLogin()" name="send">
    </fieldset>
</form>

</body>
</html>