<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CMS 内容管理系统 0.1</title>

    <link rel="stylesheet" href="style/basic.css">
    <link rel="stylesheet" href="style/details.css">
</head>
<body>

{include file="header.tpl"}

<div id="details">

    <h2>当前位置 &gt; {$nav}</h2>

    <h3>{$titlec}</h3>
    <div class="d1">
        时间：{$date}
        来源：{$source}
        作者：{$author}
        点击量：{$count}
    </div>
    <div class="d2">{$info}</div>
    <div class="d3">{$content}</div>

</div>

<div id="sidebar">
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