<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
  <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0,user-scalable=no" />
  <meta name="renderer" content="webkit" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />	
	<title>正在直播中.... {cms_title}</title>
	<meta name="keywords" content="{cms_title}" />
	<meta name="description" content="{cms_title}" />
    <link rel="stylesheet" href="{cms_template}/css/index.css" />
</head>
<body>
{include file="header.php"}
  <main class="main" style="padding: 10px 8px 8px 8px;"> 
   <div id="propagandaInsert" class="flex-row cross_line"></div> 
   <div id="propagandaBottom"></div>
       <h1 class="h1">本直播为实时直播！</h1>
  <section class="videos"  >
			{cmsobj_content}
      </section>

        <div id="propagandaInsert" class="flex-row cross_line" style="display: flex;">
	{cms_banner_b}
		</div>



   
  </main>{include file="footer.php"}
 
</body>
</html>