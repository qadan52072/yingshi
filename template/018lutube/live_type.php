<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<title>{type_name} - {cms_title}</title>
<meta name="keywords" content="{cms_keywords}" />
<meta name="description" content="{cms_description}" />
<link href="{cms_template}/css/style.css" rel="stylesheet">
<meta name="theme-color" content="#ffffff">
</head>
<body  data-host="221" class="list hd" data-uid="">
{include file="header.php"}
<div class="alert alert-default text-center " style="margin:10px 4px 0 4px;padding:0" id="domaintip">  <div class="dropdown">直播分类：{type_name}</div></div>
{live_list:30}
<div class="video" id="v_VuHKbdWnH2">
    <a href=" {list_view}">
        <div class="vimg">
            <img src=" {list_pic}">
            <span class="vlen">本站提供</span><span class="icon_promote icon_promote_right" style="width:100%;height:100%"><span>时时直播</span></span>
        </div>
        <p class="title"><span class="glyphicon glyphicon-hd-video" style="color:#337ab7"></span> {list_name} </p>
    </a>
</div>

		 {/live_list}

<div class="loading clearfix" data-page="0" data-pagesize="10">
    <a class="page_btn" href="{cms_page:first}">首页</a>
    <a class="page_btn" href="{cms_page:prev}">上一页</a>
    <a class="page_btn" href="javascript:;">共{cms_page:count}页</a>
    <a class="page_btn" href="javascript:;">当前第{cms_page:current}页</a>
    <a class="page_btn" href="{cms_page:next}">下一页</a>
    <a class="page_btn" href="{cms_page:last}">尾页</a>
</div>


 
{include file="footer.php"}
</body>
</html>		
