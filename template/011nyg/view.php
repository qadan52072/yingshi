<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
  <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0,user-scalable=no" />
  <meta name="renderer" content="webkit" />
	<title>正在播放 {cmsobj_name}</title>
	<meta name="keywords" content="{cms_keywords}" />
	<meta name="description" content="{cms_description}" />
    <link rel="stylesheet" href="{cms_template}/css/index.css" />
</head>
<body>
{include file="header.php"}
  <main class="main" style="padding: 10px 8px 8px 8px;"> 
   <div id="propagandaInsert" class="flex-row cross_line"></div> 
   <div id="propagandaBottom"></div>
       <h1 class="h1">您的位置：视频播放{cmsobj_name}</h1>
  <section class="videos"   style="height:400px"> 
    		{cmsobj_content}
      </section>

        <div id="propagandaInsert" class="flex-row cross_line" style="display: flex;">
	{cms_banner_b}
		</div>

    <section class="videos"> 
    <h1 class="h1">视频推荐</h1> 
    <div class="flex-row"> 
     <div id="propagandaLeft"></div> 
     <div class="content"> 
		 	{video_list:12}
      <div class="grid_item"> 
       <a class="link" href=" {list_view}">
        <div class="img_post icont icon_kiss"> 
         <span class="info_lable"> <i class="info-item">HD</i> </span> 
         <img class="img" src="{list_pic}" data-reload="3"  />
        </div> 
		<p class="description"><span class="span">{list_name}</span>{list_name}</p>
        <div class="inform"> 
         <span class="num">{list_time}</span>
         <span class="iconfont icon-praisefill">  {list_hit}; </span>
        </div> </a> 
      </div> 
				 {/video_list}	</div>
     <div id="propagandaRight"></div> 
    </div> 
   </section>  

   
  </main>{include file="footer.php"}
 
</body>
</html>
