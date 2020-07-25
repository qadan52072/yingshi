<!DOCTYPE html>
<html lang="en">
 <head> 
  <meta charset="UTF-8" />
  <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0,user-scalable=no" />
  <meta name="renderer" content="webkit" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
	<title>{cms_title}</title>
	<meta name="keywords" content="{cms_keywords}" />
	<meta name="description" content="{cms_description}" />
    <link rel="stylesheet" href="{cms_template}/css/index.css?v=1" />

 </head> 
 <body> 
  {include file="header.php"}
 
 
  <main class="main" style="padding: 10px 8px 8px 8px;"> 
   <div id="propagandaInsert" class="flex-row cross_line"></div> 
   <div id="propagandaBottom"></div>

      {if $cms_config['live_status']=='1'}

          <section class="broadcast">
              <h1 class="h1">直播推荐|公告： {cms_notice}</h1>
              <div class="content">
                  <div class="scroll">
                    {live_hot_list:12}
                          <a class="img_post icont icon_kiss" href=" {list_view}"> <img class="img" src=" {list_pic}"/> </a>
                    {/live_hot_list}


                  </div>
              </div>
          </section>

      {/if}


      {video_hot}
          <section class="videos">
              <h1 class="h1">{type_name}</h1>
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
                                      <span class="iconfont icon-praisefill">  {list_hit} </span>
                                  </div> </a>
                          </div>
                      		 {/video_list}	</div>
                  <div id="propagandaRight"></div>
              </div>
          </section>

      {/video_hot}



    
    
      <!--
  友情链接预留调用方式：链接=友联URL  标题=友联名称-->  
   <section class="videos" style="margin-top: 20px;font-size:16px">
     	<h1 class="h1">友情链接</h1> 
		<div  class="f-links" style="overflow:hidden;">
       		<ul>
       		 {cms_link}
         	</ul>
      	</div>     
   </section>
  </main>{include file="footer.php"}
 </body>
</html>
