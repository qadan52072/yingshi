<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{type_name} - {cms_title}</title>
    <meta name="description" content="{type_name},{cms_description}" />
    <meta name="keywords" content="{type_name},{cms_keywords}" />
    {include file="include.php"}
</head>
<body>
{include file="header.php"}

<div class="qr-content">
    <div class="qr-block qr-block-title">
        <span class="title-bg"><i class="layui-icon layui-icon-template"></i> {type_name}</span>
    </div>
    <div class="layui-row">
        <div class="layui-col-xs12 book-list">
            <ul>
                {book_list:24}
                <a href="{list_view}" target="_blank">
                    <li style="white-space: normal;text-overflow: ellipsis;overflow: hidden">
                        <div class="layui-row">
                            <div class="layui-col-xs12 layui-col-sm8">【{type_name}】{list_name}</div>
                            <div class="layui-hide-xs layui-show-sm-block layui-col-sm4" style="text-align: right">{list_time}</div>
                        </div>
                    </li>
                </a>
                {/book_list}
            </ul>
        </div>
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