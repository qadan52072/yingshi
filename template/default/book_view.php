<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{cmsobj_name}在线阅读 - {cms_title}</title>
    <meta name="description" content="{cmsobj_name}在线阅读,{cms_description}" />
    <meta name="keywords" content="{cmsobj_name}在线阅读,{cms_keywords}" />
    {include file="include.php"}
</head>
<body>
{include file="header.php"}

<div class="qr-content">
    <div class="qr-block qr-block-white" style="background: linear-gradient(to right, #c5a073, #dac3a1 20%, #dac3a1 80%,#c5a073);">
            <center><h1>{cmsobj_name}</h1></center>
            <br/><br/>
            <div class="book-content" style="font-size:17px; line-height:34px">
                {cmsobj_content}
            </div>
    </div>
        <div class="qr-block qr-block-title">
            <span class="title-bg"><i class="layui-icon layui-icon-app"></i> 猜你喜欢</span>
        </div>
    <div class="layui-row">
        <div class="layui-col-xs12 book-list">
            <ul>
                {book_list:10}
                <a href="{list_view}" target="_blank">
                    <li style="white-space: normal;text-overflow: ellipsis;overflow: hidden">
                        <div class="layui-row">
                            <div class="layui-col-xs12 layui-col-sm8">【{cmsobj_typename}】{list_name}</div>
                            <div class="layui-hide-xs layui-show-sm-block layui-col-sm4" style="text-align: right">{list_time}</div>
                        </div>
                    </li>
                </a>
                {/book_list}
            </ul>
        </div>
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