<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
  <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0,user-scalable=no" />
  <meta name="renderer" content="webkit" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />	
	<title>{type_name} - 文章列表 - {cms_title}</title>
	<meta name="keywords" content="{cms_keywords}" />
	<meta name="description" content="{cms_description}" />
    <link rel="stylesheet" href="{cms_template}/css/index.css" />
</head>
<body>
{include file="header.php"}
  <main class="main" style="padding: 10px 8px 8px 8px;"> 
   <div id="propagandaInsert" class="flex-row cross_line"></div> 
   <div id="propagandaBottom"></div>
    <section class="videos"> 
    <h1 class="h1">图片专区:{type_name}</h1>
    <div class="flex-row"> 
     <div id="propagandaLeft"></div> 
     <div class="content"> 
			{pic_list:20}
      <div class="grid_item"> 
       <a class="link" href="{list_view}">
		<p class="description"><span class="span">{list_name}</span>{list_name}</p>
		</a> 
      </div> 
				 {/pic_list}	</div>
     <div id="propagandaRight"></div> 
    </div> 
   </section>  
<div class="pagenote flex-row">
    <a class="prev link" href="{cms_page:first}">首页</a>
    <a class="prev link" href="{cms_page:prev}">上一页</a>
    <a class="link">共{cms_page:count}页</a>
    <a class="link">当前 {cms_page:current}页</a>
    <a class="next link" href="{cms_page:next}">下一页</a>
    <a class="next link" href="{cms_page:last}">尾页</a>
        </div>
   
  </main>




{include file="footer.php"}
	
</body>
</html>		
	