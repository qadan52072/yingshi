<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<title>
        {type_name} - {cms_title}
	</title>
	<meta name="keywords" content="{cms_keywords}" />
	<meta name="description" content="{cms_description}" />
	<link href="{cms_template}/css/style.css" rel="stylesheet">
	<link href="{cms_template}/css/style2.css" rel="stylesheet">
	<meta name="theme-color" content="#ffffff">
</head>

<body data-host="221" class="list hd" data-uid="">
	{include file="header.php"}
	<div class="alert alert-default text-center title-box" style="margin:10px 4px 0 4px;padding:0" id="domaintip">
		<div class="dropdown title">图片分类：
			{type_name}
		</div>
	</div>
	
	
	<ul class="art-list" style="padding: 0 25px;">
		   {pic_list:20}
		<li>
			<p>
				<a href="{list_view}" target="_blank">
					{list_name}
				</a>
			</p>
			<span>{list_time}</span>
		</li>
		 {/pic_list}
	</ul>

	<div class="loading clearfix pagenation" data-page="0" data-pagesize="10">
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