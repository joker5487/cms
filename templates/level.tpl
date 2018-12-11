<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main</title>

    <link rel="stylesheet" href="../style/admin.css">

    <script type="text/javascript" src="../js/admin_level.js"></script>
</head>
<body id="main">

    <div class="map">
        管理首页 &gt;&gt; 等级管理 &gt;&gt; <strong id="title">{$title}</strong>
    </div>

    <ol>
        <li><a href="level.php?action=show" class="selected">等级列表</a></li>
        <li><a href="level.php?action=add">新增等级</a></li>
        {if $update}
            <li><a href="level.php?action=update&id={$id}">修改等级</a></li>
        {/if}
    </ol>

    {if $show}
        <table cellspacing="0">
            <tr>
                <th>编号</th>
                <th>等级名称</th>
                <th>等级描述</th>
                <th>操作</th>
            </tr>

            {foreach $AllLevel(key, value)}
                <tr>
                    <td>{@value->id}</td>
                    <td>{@value->level_name}</td>
                    <td>{@value->level_info}</td>
                    <td><a href="level.php?action=update&id={@value->id}">修改</a> | <a href="level.php?action=delete&id={@value->id}" onclick="return confirm('您确定要删除该等级吗？') ? true : false">删除</a></td>
                </tr>
            {/foreach}
        </table>
    {/if}

    {if $add}
        <form method="post" name="add">
            <table cellspacing="0" class="left">
                <tr><td>等级名称：<input type="text" name="level_name" class="text"> (* 等级名称不能小于2位，不能大于20位)</td></tr>
                <tr><td><textarea name="level_info" id="" cols="30" rows="10"></textarea> (* 等级描述不能大于200位)</td></tr>
                <tr><td><input type="submit" name="send" value="新增等级" onclick="return checkForm();" class="submit level"> 【 <a href="level.php?action=show">返回列表</a> 】</td></tr>
            </table>
        </form>
    {/if}

    {if $update}
        <form method="post" name="add">
            <input type="hidden" value="{$id}" name="id">
            <table cellspacing="0" class="left">
                <tr><td>等级名称：<input type="text" name="level_name" class="text" value="{$level_name}"></td></tr>
                <tr><td><textarea name="level_info" id="" cols="30" rows="10">{$level_info}</textarea></td></tr>
                <tr><td><input type="submit" name="send" value="修改等级" onclick="return checkForm();" class="submit level"> 【 <a href="level.php?action=show">返回列表</a> 】</td></tr>
            </table>
        </form>
    {/if}

    {if $delete}
        删除界面
    {/if}

</body>
</html>