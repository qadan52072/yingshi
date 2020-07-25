<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<title>正在播放 {cmsobj_name}</title>
<meta name="keywords" content="{cms_keywords}" />
<meta name="description" content="{cms_description}" />
<link href="{cms_template}/css/style.css" rel="stylesheet">
<meta name="theme-color" content="#ffffff">
</head>
<body  data-host="221" class="list hd" data-uid="">
{include file="header.php"}
<div class="alert alert-default text-center " style="margin:10px 4px 0 4px;padding:0" id="domaintip">  <div class="dropdown">{cmsobj_name}</div></div>
<div  style="height:400px">
{cmsobj_content}
</div>
{cms_banner_b}
<div class="alert alert-default text-center " style="margin:10px 4px 0 4px;padding:0" id="domaintip">  <div class="dropdown">推荐视频</div></div>
 	{video_list:10}

<div class="video" id="v_VuHKbdWnH2">
    <a href=" {list_view}">
        <div class="vimg">
            <img src="{list_pic}">
            <span class="vlen">上架时间：{list_time}</span><span class="icon_promote icon_promote_right" style="width:100%;height:100%"><span>推荐视频</span></span>
        </div>
        <p class="title"><span class="glyphicon glyphicon-hd-video" style="color:#337ab7"></span>{list_name}</p>
    </a>
</div>
		 {/video_list}


{include file="footer.php"}
</body>
</html>
