<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CMS 内容管理系统 0.1</title>

    <link rel="stylesheet" href="style/basic.css">
    <link rel="stylesheet" href="style/list.css">
</head>
<body>

    {include file="header.tpl"}

    <div id="list">

        <h2>当前位置 &gt; {$nav}</h2>

        <dl>
            <dt><img src="images/none.jpg" alt=""></dt>
            <dd>[<strong>军事动态</strong>] <a href="###">联合利华因散布涨价信息被罚200W</a></dd>
            <dd>日期：2018年12月24日 12:12:12 点击率：224 好评：0</dd>
            <dd>核心提示：国际发改委发布公告称，联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚核心提示：国际发改委发布公告称，联合利涨价信息被罚联合利华因散...</dd>
        </dl>

        <dl>
            <dt><img src="images/none.jpg" alt=""></dt>
            <dd>[<strong>军事动态</strong>] <a href="###">联合利华因散布涨价信息被罚200W</a></dd>
            <dd>日期：2018年12月24日 12:12:12 点击率：224 好评：0</dd>
            <dd>核心提示：国际发改委发布公告称，联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚核心提示：国际发改委发布公告称，联合利涨价信息被罚联合利华因散...</dd>
        </dl>

        <dl>
            <dt><img src="images/none.jpg" alt=""></dt>
            <dd>[<strong>军事动态</strong>] <a href="###">联合利华因散布涨价信息被罚200W</a></dd>
            <dd>日期：2018年12月24日 12:12:12 点击率：224 好评：0</dd>
            <dd>核心提示：国际发改委发布公告称，联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚核心提示：国际发改委发布公告称，联合利涨价信息被罚联合利华因散...</dd>
        </dl>

        <dl>
            <dt><img src="images/none.jpg" alt=""></dt>
            <dd>[<strong>军事动态</strong>] <a href="###">联合利华因散布涨价信息被罚200W</a></dd>
            <dd>日期：2018年12月24日 12:12:12 点击率：224 好评：0</dd>
            <dd>核心提示：国际发改委发布公告称，联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚核心提示：国际发改委发布公告称，联合利涨价信息被罚联合利华因散...</dd>
        </dl>

        <dl>
            <dt><img src="images/none.jpg" alt=""></dt>
            <dd>[<strong>军事动态</strong>] <a href="###">联合利华因散布涨价信息被罚200W</a></dd>
            <dd>日期：2018年12月24日 12:12:12 点击率：224 好评：0</dd>
            <dd>核心提示：国际发改委发布公告称，联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚联合利华因散布涨价信息被罚核心提示：国际发改委发布公告称，联合利涨价信息被罚联合利华因散...</dd>
        </dl>

        <div id="page">分页</div>
    </div>

    <div id="sidebar">
        <div class="nav">
            <h2>子栏目列表</h2>
            {if $childNav}
                {foreach $childNav(key, value)}
                    <strong><a href="list.php?id={@value->id}">{@value->nav_name}</a></strong>
                {/foreach}
            {else}
                <span>该栏没有子类</span>
            {/if}
        </div>

        <div class="right">
            <h2>本类推荐</h2>
            <ul>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
            </ul>
        </div>

        <div class="right">
            <h2>本类热点</h2>
            <ul>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
            </ul>
        </div>

        <div class="right">
            <h2>本类图文</h2>
            <ul>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
                <li><em>06-20</em><a href="###">银监会否认首套房贷首付将提至...</a></li>
            </ul>
        </div>
    </div>

    {include file='footer.tpl'}

</body>
</html>