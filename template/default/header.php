
<div class="layui-header layui-bg-t layui-hide-xs">
    <div class="qr-content layui-row">
        <div class="layui-logo pc layui-col-sm4">
            <a href="/"><?php echo strtoupper($_SERVER['HTTP_HOST']);?></a>
        </div>
        <div class="login-box layui-hide-sm layui-show-md-block layui-col-md8">
            <button class="layui-btn layui-btn-success" onclick="layer.alert('请使用ctrl+D收藏这个网页')">请牢记本站域名:</button>
            <a class="layui-btn layui-btn-normal"  href="//{cms_domain1}">{cms_domain1}</a>
            <a class="layui-btn layui-btn-normal"  href="//{cms_domain2}">{cms_domain2}</a>
            <button class="layui-btn layui-btn-normal" onclick="showsearch()">搜索</button>
            {if $cms_config['user_status'] == '1'}
            <a class="layui-btn layui-btn-normal" href="{:U('user','info',1,1)}">个人中心</a>
            {/if}
        </div>
    </div>

</div>


<div class="layui-header layui-row layui-bg-t layui-hide-sm">
    <div class="layui-logo layui-col-xs2">
        <a class="qr-icon" href="javascript:showsearch();"><i class="layui-icon layui-icon-search"></i></a>
    </div>
    <div class="layui-logo layui-col-xs8">
        {if $cms_controller == 'index'}
            {cms_title}
        {elseif $cms_action == 'view'||$cms_action == 'detail'}
            {cmsobj_name}
        {else}
            {type_name}
        {/if}
    </div>
    <div class="layui-logo layui-col-xs2">
        <a class="qr-icon" href="javascript:right();" style="padding: 0"><i class="layui-icon layui-icon-shrink-right"></i></a>
    </div>

</div>
<div class="qr-right-menu layui-hide-sm layui-show-xs-block">
    <table  class="layui-table" lay-even lay-skin="line" lay-size="lg">
        <colgroup>
            <col>
        </colgroup>
        <tbody>
        {if $cms_config['user_status'] == '1'}
        <tr><td><a class="layui-btn layui-btn-normal" href="{:U('user','info',1,1)}">个人中心</a></td></tr>
        {/if}
        {if $cms_controller == 'index'||$cms_controller == 'search'}
        <tr><td><a href="javascript:;">👇👇精品推荐👇👇</a></td></tr>
            {hd_menu}
                <tr><td><a href="{menu_link}">{menu_name}</a></td></tr>
            {/hd_menu}
        {/if}
        {if $cms_controller == 'vod'}
            {hd_menu}
                <tr><td><a href="{menu_link}">{menu_name}</a></td></tr>
            {/hd_menu}
            {video_menu}
                <tr><td><a href="{menu_link}">{menu_name}</a></td></tr>
            {/video_menu}
        {/if}
        {if $cms_controller == 'pic'}
            {pic_menu}
                <tr><td><a href="{menu_link}">{menu_name}</a></td></tr>
            {/pic_menu}
        {/if}
        {if $cms_controller == 'book'}
            {book_menu}
                <tr><td><a href="{menu_link}">{menu_name}</a></td></tr>
            {/book_menu}
        {/if}
        {if $cms_controller == 'live'}
            {live_menu}
                <tr><td><a href="{menu_link}">{menu_name}</a></td></tr>
            {/live_menu}
        {/if}
        </tbody>
    </table>
</div>
<div class="search-box">
    <form action="">
        {cms_search}
        <input type="text" name="TXT" placeholder="请输入电影名或标题">
    </form>
</div>
<script>
    var right = function(){
        document.querySelector(".qr-right-menu").classList.toggle("active");
    }
    var showsearch = function(){
        document.querySelector(".search-box").classList.toggle("active");
    }
</script>

<div class="qr-content qr-block layui-hide-xs layui-show-sm-block">
    <ul class="qr-nav">
        <li class="layui-col-sm2 active">
            <a href=""><i class="layui-icon layui-icon-play"></i> 在线视频</a>
        </li>
        {video_menu}
        <li class="layui-col-sm2">
            <a href="{menu_link}">{menu_name}</a>
        </li>
        {/video_menu}
    </ul>

</div>
<div class="qr-content qr-block layui-hide-xs layui-show-sm-block">
    <ul class="qr-nav">
        <li class="layui-col-sm2 active">
            <a href=""><i class="layui-icon layui-icon-chart-screen"></i> 高清影院</a>
        </li>
        {hd_menu}
        <li class="layui-col-sm2">
            <a href="{menu_link}">{menu_name}</a>
        </li>
        {/hd_menu}
    </ul>

</div>
<div class="qr-content qr-block layui-hide-xs layui-show-sm-block">
    <ul class="qr-nav">
        <li class="layui-col-sm2 active">
            <a href=""><i class="layui-icon layui-icon-carousel"></i> 图片自拍</a>
        </li>
        {pic_menu}
        <li class="layui-col-sm2">
            <a href="{menu_link}">{menu_name}</a>
        </li>
        {/pic_menu}
    </ul>

</div>
<div class="qr-content qr-block layui-hide-xs layui-show-sm-block">
    <ul class="qr-nav">
        <li class="layui-col-sm2 active">
            <a href=""><i class="layui-icon layui-icon-read"></i> 小说阅读</a>
        </li>
        {book_menu}
        <li class="layui-col-sm2">
            <a href="{menu_link}">{menu_name}</a>
        </li>
        {/book_menu}
    </ul>

</div>
{if $cms_config['live_status'] == '1'}
<div class="qr-content qr-block layui-hide-xs layui-show-sm-block">
    <ul class="qr-nav">
        <li class="layui-col-sm2 active">
            <a href=""><i class="layui-icon layui-icon-video"></i> 激情直播</a>
        </li>
        {live_menu}
        <li class="layui-col-sm2">
            <a href="{menu_link}">{menu_name}</a>
        </li>
        {/live_menu}
    </ul>

</div>
{/if}
<div class="qr-content qr-block banner-pc">
    {cms_banner_a}
</div>
