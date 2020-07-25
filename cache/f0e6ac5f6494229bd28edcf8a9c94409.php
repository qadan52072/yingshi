<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<title>
        <?php echo $cmsobj_name; ?> - <?php echo $cms_title; ?>
	</title>
	<meta name="keywords" content="<?php echo $cms_keywords; ?>" />
	<meta name="description" content="<?php echo $cms_description; ?>" />
	<link href="<?php echo $cms_template; ?>/css/style.css" rel="stylesheet">
	<link href="<?php echo $cms_template; ?>/css/style2.css" rel="stylesheet">
	<meta name="theme-color" content="#ffffff">
</head>

<body data-host="221" class="list hd" data-uid="">
	
<!--header-->
<div class="header">
    <div class="logo" style="display: flex;">
        <a href="/" style="display: flex; justify-content: center; align-items: center;">
<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEgAAAA0CAYAAAApDX79AAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAANxSURBVHja7JtLaBNBGMdnt2mstolBY40PlPooCFaxWFDEg1AREXrwpIInhSKCgo+DDwTFx0F6EsSLgiCIgnhSRFAEoShYiCB4kB5aoTUaa6SkTdM06/9LZsPkVa26uzPN/OHXb2hJd/vr7GYeG4NNE8uyIiidYDNoAYtACMzndR5TI+PgJ0hw4mAAvAMvDcMYnNFvg5i14C6YsGZ/MuAhaKvkwqggZx/KbYV6x/9KGhxHb7pVVRDk7Ee5B0xWuzkGSTfKBEEO3WM+1GDPKU0GdEBSlJX0lAtaTi4+cLmoB6H3NKHEtKBCsmA5etGw3YP2ajlFIS8HxEusSzspS5d4idHl1aydFGUCBEzIWaLlVMwcsM7kUwidymkhQcu0h6pZSoIi2kPVRLwQ9AA8VkRQs8mXMNxMPwZgNO7aCl5JLihMgsJeHBmS3oAdaO4GUUkFLSRBC7w8A0h6htLOR679kgkKkaCQ12cBSRa4T+MOcBR8kURQkAQ1yfLvgqRJcBPNNeA8yy+Tepm5JKhRtgsfkpLgCpqrQQ9IeXQqDVIKEkR9B6fQbAV3wJQXgqRf5oCkz+AQmm0uj6FygupUGdZC0kc+htri0hjKVHJxHpLeujWGUnr3omQMNaQFVc4KsMupOaVPVSuWZdEU6Rw4wvKLW8wpQVmVehLfgTkB6O0/4PThSNCYTKPpacT4Ubr5CNutJeIUCUrKLAhi7C2YS8z95eGCIFnl7EG5CjZ4dApyCoKYbSjXwHaPTyUnKCGRmPUoNEmVZSNzlAT9kEDMSpSL4KBk76gJEhT3UAyth591eizzDxkhQd88Gsuc5ASYvImToJjLB90JDjM1tru/kqBhlw/aodCMJmY6NQueJRkiQQPaQ9UMGrhh0jNCI0yC7R/JQuvfQZP2pNDo1T7KEoWbMXtQ9lT7KMsT+mI/ghfmN+t67aWQVvSgT7kehEbcNqaTSy/JKfQg3os2ovQxhbaBHEwnBL1g4sQQ33iPcka7YT22HFY6c8YPrrP8Wm+mVuWA038ymWwHj0Daqo308dXLshi/EbUYhV64CdBi1iqW33/yK9pD6DNh4icO6Z77HFfO62ovMP5yuYKeCAmy/GJ/I68NJfgF6gV8AnVCtZ8ToHOyOFnOFCfDmeSkeaWn4lMCtFOTFBglMRAxPtO/9ZcAAwCpNLlagcMifwAAAABJRU5ErkJggg==" alt="Logo Image">        </a>
    </div>


    <div class="pull-right uplink hidden-xs" style="width:auto; margin-right: 15px;">
        <a href="<?php echo $cms_domain1; ?>" style="font-size:14px;color:#FFF;text-decoration:none">发布地址一</a>
		<a href="<?php echo $cms_domain2; ?>" style="font-size:14px;color:#FFF;text-decoration:none">发布地址二</a>
    </div>

    <h1 class="title"><a href="/" style="color:#FFF"><?php echo $cms_title; ?></a></h1>

</div>
<!--header-->

<!--navs-->
<div class="navibar ">
    <a href="/" class="btn btn-link on"><small>首页</small></a>

					<?php foreach ($cms_menu['vod'] as $item){ $menu_type='vod';$menu_id=$item['id'];if ($item['hd'] == '0'){?>
                                <a class="btn btn-link on" href="<?php echo U($menu_type,'type',$menu_id,'1');?>"><small><?php echo $item['name']?></small></a>
                    <?php }}?>
    <?php foreach ($cms_menu['vod'] as $item){ $menu_type='vod';$menu_id=$item['id'];if ($item['hd'] == '1'){?>
    <a class="btn btn-link on" href="<?php echo U($menu_type,'type',$menu_id,'1');?>"><small><?php echo $item['name']?></small></a>
    <?php }}?>
    <?php foreach ($cms_menu['book'] as $item){ $menu_type='book';$menu_id=$item['id'];?>
    <a class="btn btn-link on" href="<?php echo U($menu_type,'type',$menu_id,'1');?>"><small><?php echo $item['name']?></small></a>
    <?php }?>
    <?php foreach ($cms_menu['pic'] as $item){ $menu_type='pic';$menu_id=$item['id'];?>
    <a class="btn btn-link on" href="<?php echo U($menu_type,'type',$menu_id,'1');?>"><small><?php echo $item['name']?></small></a>
    <?php }?>
    <?php if( $cms_config['live_status'] == '1') { ?>
    <?php foreach ($cms_menu['live'] as $item){ $menu_type='live';$menu_id=$item['id'];?>
    <a class="btn btn-link on" href="<?php echo U($menu_type,'type',$menu_id,'1');?>"><small><?php echo $item['name']?></small></a>
    <?php }?>
    <?php } ?>
</div>
<div class="alert alert-default text-center " style="margin:10px 4px 0 4px;padding:0" id="domaintip">  <div class="dropdown">公告：<?php echo $cms_notice; ?></div></div>
	<?php cms_banner_a('<a href="链接"  target="_blank"  ><img style="width:100%;margin-bottom:2px;" src="图片"></a>');?>

	<div class="alert alert-default text-center title-box" style="margin:10px 4px 0 4px;padding:0" id="domaintip">
		<div class="dropdown title" style="font-size: 22px;">
			<?php echo $cmsobj_name; ?>
		</div>
	</div>
	
	
	<div class="book-content" style="padding:20px">
		<p>
			<span><?php echo $cmsobj_content; ?></span>
		</p>
	</div>
		
		



	<div class="footer">
    <div id="flinks">
    <h5>广告合作联系方式：<?php echo $cms_email; ?></h5>
      <style>
            #flinks h5 { color: #a9a9a9; margin-top: 35px; font-size: 15px; font-weight: normal; }
            #flinks p { overflow: hidden;}
            #flinks p a {margin-right: 10px; color:#9f9f9f; }
            #flinks p a:hover {margin-right: 10px; color:#ff8000; }
     </style>
</div>
    <?php 
include('./class/class_ad_Popup.php');
include('./class/cllass_ad_js.php');
include('./class/class_ad_float.php');
include('./class/class_statistics.php');
?>
    Copyright &copy;2012-2019    </div>

</body>

</html>