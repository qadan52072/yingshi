<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{cms_title}</title>
    <meta name="description" content="{cms_description}" />
    <meta name="keywords" content="{cms_keywords}" />
    {include file="include.php"}
</head>
<body>
{include file="header.php"}

<div class="qr-content">
        <div class="layui-row video-list">
            {video_list:20}
            <div class="video-item" onclick="window.open('{list_detail}','_blank')">
                <div class="layui-row">
                    <div class="video-list-title-top layui-hide-sm layui-col-xs12">
                        <span>{type_name}</span>
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
    <div class="qr-block qr-block-white" style="margin-bottom: 99px;"><center>{include file="page.php"}</center></div>
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