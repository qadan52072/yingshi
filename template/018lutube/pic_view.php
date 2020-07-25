<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<title>
        {cmsobj_name} - {cms_title}
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
		<div class="dropdown title" style="font-size: 22px;">
			{cmsobj_name}
		</div>
	</div>
	
	<div class="img-content">
		<p>
			{cmsobj_content}
		</p>
	</div>
		
		



	{include file="footer.php"}
</body>

</html>