<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{cmsobj_name} - {cms_title}</title>
    <meta name="description" content="{cmsobj_name},{cms_description}" />
    <meta name="keywords" content="{cmsobj_name},{cms_keywords}" />
    {include file="include.php"}
</head>
<body>
{include file="header.php"}

<div class="qr-content">
    <div class="qr-block qr-block-white">
            <center><h1>{cmsobj_name}</h1></center>
            <br/><br/>
            <div class="pic_view">
                {cmsobj_content}
            </div>
    </div>
        <div class="qr-block qr-block-title">
            <span class="title-bg"><i class="layui-icon layui-icon-app"></i> 猜你喜欢</span>
        </div>
    <div class="layui-row video-list">
        {pic_list:8}
        <div class="video-item" onclick="window.open('{list_view}','_blank')">
            <div class="layui-row">
                <div class="video-list-title-top layui-hide-sm layui-col-xs12">
                    <span>{cmsobj_typename}</span>
                    <p>{list_name}</p>
                </div>
                <div class="layui-col-xs12 layui-col-sm12" style="max-height: 250px;overflow: hidden">
                    <a href="{list_view}"></a>
                    <img src="{list_pic}" width="100%">
                </div>
                <div class="video-list-title-bottom layui-hide-xs layui-col-sm12">{list_name}</div>
                <div class="video-bar layui-col-sm12">
                    <div class="layui-row">
                        <div class="layui-col-xs6"><i class="layui-icon layui-icon-fire"></i> {list_hit} </div>
                        <div class="layui-col-xs6">{list_time}</div>
                    </div>
                </div>
            </div>
        </div>
        {/pic_list}
    </div>
</div>
<script>
    window.onload = function () {
        layui.use(['jquery','element'],function () {
            var ele = layui.element;
            var $ = layui.jquery;
            layer.photos({
                photos: '.qr-block-white'
                ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
            });
        })
    }
</script>
{include file="footer.php"}