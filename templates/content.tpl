<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main</title>

    <link rel="stylesheet" href="../style/admin.css">

    <script type="text/javascript" src="../ckeditor4_8/ckeditor.js"></script>
    <script type="text/javascript" src="../js/admin_content.js"></script>
</head>
<body id="main">

<div class="map">
    内容首页 &gt;&gt; 查看文档列表 &gt;&gt; <strong id="title">{$title}</strong>
</div>

<ol>
    <li><a href="content.php?action=show" class="selected">文档列表</a></li>
    <li><a href="content.php?action=add">新增文档</a></li>
    {if $update}
        <li><a href="content.php?action=update&id={$id}">修改文档</a></li>
    {/if}
</ol>

{if $add}
    <form name="content" action="">
        <table cellspacing="0" class="content">
            <tr><th><strong>发布一条新文档</strong></th></tr>
            <tr><td><label for="">文档标题：</label><input type="text" name="title" class="text"></td></tr>
            <tr>
                <td>
                    <label for="">栏目：</label>
                    <select name="" id="">
                        <option value="">请选择一个栏目类别</option>
                        <option value="">AAA</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">定义属性：</label>
                    <input type="checkbox" name="top" value="头条">头条
                    <input type="checkbox" name="rec" value="推荐">推荐
                    <input type="checkbox" name="bold" value="加粗">加粗
                    <input type="checkbox" name="skip" value="跳转">跳转
                </td>
            </tr>
            <tr><td><label for="">标签：</label><input type="text" name="tag" class="text"></td></tr>
            <tr><td><label for="">关键字：</label><input type="text" name="keyword" class="text"></td></tr>
            <tr>
                <td>
                    <label for="">缩略图：</label><input type="text" name="thumbnail" class="text" disabled="disabled"> <input type="button" value="上传缩略图" onclick="centerWindow('../templates/upfile.html', 'upfile', 400, 100);">
                    <img src="" alt="" name="pic" style="display: none;">
                </td>
            </tr>
            <tr><td><label for="">文章来源：</label><input type="text" name="source" class="text"></td></tr>
            <tr><td><label for="">作者：</label><input type="text" name="author" class="text"></td></tr>
            <tr><td class="textarea"><label for="">内容摘要：</label><textarea name="info" id="" cols="30" rows="10"></textarea></td></tr>
            <tr class="ckeditor">
                <td class="textarea">
                    <textarea name="ckeditor" class="ckeditor"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">评论选项：</label>
                    <input type="radio" name="commend" value="1" checked="checked">允许评论
                    &nbsp;&nbsp;
                    <input type="radio" name="commend" value="0">禁止评论
                </td>
                <td>
                    <label for="">浏览次数：</label>
                    <input type="text" name="count" value="100" class="">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">文档排序：</label>
                    <select name="sort" id="">
                        <option value="">默认排序</option>
                        <option value="">置顶一天</option>
                        <option value="">置顶一周</option>
                        <option value="">置顶一月</option>
                        <option value="">置顶一年</option>
                    </select>
                </td>
                <td>
                    <label for="">消费金币：</label>
                    <input type="text" name="count" value="0" class="">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">阅读权限：</label>
                    <select name="limit" id="">
                        <option value="">开放浏览</option>
                        <option value="">初级会员</option>
                        <option value="">中级会员</option>
                        <option value="">高级会员</option>
                        <option value="">VIP会员</option>
                    </select>
                </td>
                <td>
                    <label for="">标题颜色：</label>
                    <select name="color" id="">
                        <option value="">默认颜色</option>
                        <option value="">红色</option>
                        <option value="">蓝色</option>
                        <option value="">橙色</option>
                    </select>
                </td>
            </tr>
            <tr><td><input type="submit" value="发布文档"> <input type="reset" value="重置"></td></tr>
            <tr><td></td></tr>
        </table>
    </form>
{/if}

</body>
</html>