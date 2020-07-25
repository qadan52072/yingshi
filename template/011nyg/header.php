  <nav class="menu flex-column"> 
   <div class="top flex-row"> 
    <a class="logo" href="/"><img class="img" src="{cms_logo}" /></a>
    <form class="search" method="get"  id="search_form">
        {cms_search}
     <input class="input_text" type="text" name="TXT" placeholder="搜索视频" autocomplete="off" onsubmit="return InputCheck(this)" />  
		
      <a href="javascript:document:search_form.submit();" class="search_submit icont icon_search"></a>

    </form></div>
   <div class="nav icont icon_slide" id="nav">
	   <div style="width:100%;overflow: auto">
		   <a class="link active" href="/">首页</a>

		   <a class="link nav_parent" href="javascript:;">视频专区</a>
		   <div class="sub_nav">
			   {video_menu}
			   <a class="link" href="{menu_link}">{menu_name}</a>
               {/video_menu}
		   </div>

		   <a class="link nav_parent" href="javascript:;">高清专区</a>
		   <div class="sub_nav">
			   {hd_menu}
			   <a class="link" href="{menu_link}">{menu_name}</a>
               {/hd_menu}
		   </div>

		   <a class="link nav_parent" href="javascript:;">小说专区</a>
		   <div class="sub_nav">
               {book_menu}
			   <a class="link" href="{menu_link}">{menu_name}</a>
               {/book_menu}
		   </div>
		   <a class="link nav_parent" href="javascript:;">图片专区</a>
		   <div class="sub_nav">
               {pic_menu}
			   <a class="link" href="{menu_link}">{menu_name}</a>
               {/pic_menu}
		   </div>
           
           {if $cms_config['live_status']=='1'}

               <a class="link nav_parent" href="javascript:;">直播专区</a>
               <div class="sub_nav">
                   {live_menu}
                       <a class="link" href="{menu_link}">{menu_name}</a>
                   {/live_menu}
               </div>
               
           {/if}



		   <a class="link nav_parent" href="javascript:;">发布地址&nbsp;&nbsp;</a>
		   <div class="sub_nav">
			   <a class="link" href="{cms_domain1}"  target="_blank" >发布地址一</a>
			   <a class="link" href="{cms_domain2}"  target="_blank" >发布地址二</a>

		   </div>
	   </div>


   </div> 
  </nav> 
  <main class="main left_spare right_spare">
        <div id="propagandaInsert" class="flex-row cross_line" style="display: flex;">
	{cms_banner_a}
		</div>
  </main>
