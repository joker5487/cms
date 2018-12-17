<div id="top">
    <a href="###">文字广告一</a>
    <a href="###">文字广告二</a>
</div>


<div id="header">
    <h1><a href="###">瓢城Web俱乐部</a></h1>
    <div class="hadver">
        <a href="###"><img src="images/hadver.png" alt="广告图"></a>
    </div>
</div>

<div id="nav">
    <ul>
        <li><a href="###">首页</a></li>
        {if $frontNav}
            {foreach $frontNav(key, value)}
                <li><a href="###">{@value->nav_name}</a></li>
            {/foreach}
        {/if}
    </ul>
</div>

<div id="search">
    <form action="">
        <select name="search" id="">
            <option selected="selected" value="">按标题</option>
            <option value="">按关键字</option>
            <option value="">全局查询</option>
        </select>
        <input type="text" name="keyword" class="text">
        <input type="submit" name="send" class="submit" value="搜索">
    </form>

    <strong>TAG标签：</strong>

    <ul>
        <li><a href="###">基金(3)</a></li>
        <li><a href="###">基金(3)</a></li>
        <li><a href="###">基金(3)</a></li>
        <li><a href="###">基金(3)</a></li>
        <li><a href="###">基金(3)</a></li>
        <li><a href="###">基金(3)</a></li>
        <li><a href="###">基金(3)</a></li>
        <li><a href="###">基金(3)</a></li>
        <li><a href="###">基金(3)</a></li>
        <li><a href="###">基金(3)</a></li>
    </ul>
</div>