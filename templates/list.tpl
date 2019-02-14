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

        {if $allListContent}
            {foreach $allListContent(key, value)}
                <dl>
                    <dt><a href="details.php?id={@value->id}" target="_blank"><img src="{@value->thumbnail}" alt="{@value->title}"></a></dt>
                    <dd>[<strong>{@value->nav_name}</strong>] <a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></dd>
                    <dd>日期：{@value->date} 点击率：{@value->count} 好评：0</dd>
                    <dd>{@value->info}</dd>
                </dl>
            {/foreach}
        {else}
            <p>该类别下没有任何数据</p>
        {/if}

        <div id="page">{$page}</div>
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