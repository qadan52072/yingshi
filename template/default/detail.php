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
    <div class="qr-block layui-row">
        <div class="layui-col-xs12">
            <div class="video-player" style="background-image: url({cmsobj_pic});background-size: cover">

            </div>
        </div>
        <div class="layui-col-xs12" style="padding: 8px;box-sizing: border-box;line-height: 48px;background-color: #fff">
            <h1 class="">{cmsobj_name}</h1>
            <h2>更新时间: {cmsobj_time}</h2>
            <h2>视频分类: {cmsobj_typename}</h2>
            <p><a href="{cmsobj_view}" class="layui-btn layui-btn-success">立即播放</a><a href="{cmsobj_view}#bofang" class="layui-btn layui-btn-primary">备用播放</a></p>
        </div>
    </div>
    {cms_banner_b}
        <div class="qr-block qr-block-title">
            <span class="title-bg"><i class="layui-icon layui-icon-app"></i> 猜你喜欢</span>
        </div>
    <div class="layui-row video-list">
        {video_list:8}
        <div class="video-item" onclick="window.open('{list_detail}','_blank')">
            <div class="layui-row">
                <div class="video-list-title-top layui-hide-sm layui-col-xs12">
                    <span>{cmsobj_typename}</span>
                    <p>{list_name}</p>
                </div>
                <div class="layui-col-xs12 layui-col-sm12" style="max-height: 250px;overflow: hidden">
                    <a href="{list_detail}"></a>
                    <img src="{list_pic}" width="100%">
                </div>
                <div class="video-list-title-bottom layui-hide-xs layui-col-sm12">{list_name}</div>
                <div class="video-bar layui-col-sm12">
                    <div class="layui-row">
                        <div class="layui-col-xs6"><i class="layui-icon layui-icon-play"></i> {list_hit} </div>
                        <div class="layui-col-xs6"> {list_time}</div>
                    </div>
                </div>
            </div>
        </div>
        {/video_list}
    </div>
</div>
<script>
    window.onload = function () {
        layui.use(['jquery','element'],function () {
            var ele = layui.element;
            var $ = layui.jquery;
        })
    }
</script>
{include file="footer.php"}