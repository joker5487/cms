<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main</title>

    <link rel="stylesheet" href="../style/admin.css">

    <script type="text/javascript" src="../js/admin_manage_option.js"></script>
</head>
<body id="main">

    <div class="map">
        管理首页 &gt;&gt; 管理员管理 &gt;&gt; <strong><?php echo $this->_vars['title'];?></strong>
    </div>

    <?php if ($this->_vars['list']) { ?>
        <table cellspacing="0">
            <tr>
                <th>编号</th>
                <th>用户名</th>
                <th>等级</th>
                <th>登录次数</th>
                <th>最近登录IP</th>
                <th>最近登录时间</th>
                <th>操作</th>
            </tr>

            <?php foreach ($this->_vars['AllManage'] as $key => $value) { ?>
                <tr>
                    <td><?php echo $value->id; ?></td>
                    <td><?php echo $value->admin_user; ?></td>
                    <td><?php echo $value->level; ?> --- <?php echo $value->level_name; ?></td>
                    <td><?php echo $value->login_count; ?></td>
                    <td><?php echo $value->last_ip; ?></td>
                    <td><?php echo $value->last_time; ?></td>
                    <td><a href="manage.php?action=update&id=<?php echo $value->id; ?>">修改</a> | <a href="manage.php?action=delete&id=<?php echo $value->id; ?>" onclick="return confirm('您确定要删除该管理员吗？') ? true : false">删除</a></td>
                </tr>
            <?php } ?>
        </table>

        <p class="center"><a href="manage.php?action=add">【 新增管理员 】</a></p>
    <?php } ?>

    <?php if ($this->_vars['add']) { ?>
        <form method="post">
            <table cellspacing="0" class="left">
                <tr><td>用户名：<input type="text" name="admin_user" class="text"></td></tr>
                <tr><td>密　码：<input type="text" name="admin_pass" class="text"></td></tr>
                <tr>
                    <td>等　级：<select name="level">
                                <option value="5">普通管理员</option>
                                <option value="6">超级管理员</option>
                               </select>
                    </td>
                </tr>
                <tr><td><input type="submit" name="send" value="新增管理员" class="submit"> 【 <a href="manage.php?action=list">返回列表</a> 】</td></tr>
            </table>
        </form>
    <?php } ?>

    <?php if ($this->_vars['update']) { ?>
        <form method="post">
            <input type="hidden" value="<?php echo $this->_vars['id'];?>" name="id">
            <input type="hidden" value="<?php echo $this->_vars['level'];?>" id="level" name="level">
            <table cellspacing="0" class="left">
                <tr><td>用户名：<input type="text" name="admin_user" value="<?php echo $this->_vars['admin_user'];?>" readonly="readonly" class="text"></td></tr>
                <tr><td>密　码：<input type="text" name="admin_pass" class="text"></td></tr>
                <tr>
                    <td>等　级：<select name="level">
                            <option value="5">普通管理员</option>
                            <option value="6">超级管理员</option>
                        </select>
                    </td>
                </tr>
                <tr><td><input type="submit" name="send" value="修改管理员" class="submit"> 【 <a href="manage.php?action=list">返回列表</a> 】</td></tr>
            </table>
        </form>
    <?php } ?>

    <?php if ($this->_vars['delete']) { ?>
        删除界面
    <?php } ?>

</body>
</html>