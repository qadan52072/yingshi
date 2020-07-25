<?php include('../admin_config/config.php');?>
<?php include('../../lib/common.php');?>
<!doctype html>
<html>
  
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>番号CMS管理中心</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="<?php echo CMS_ADMIN_url;?>assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo CMS_ADMIN_url;?>assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="<?php echo CMS_ADMIN_url;?>assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="<?php echo CMS_ADMIN_url;?>assets/css/admin.css">
    <link rel="stylesheet" href="<?php echo CMS_ADMIN_url;?>assets/css/app.css">

    <script src="<?php echo CMS_ADMIN_url;?>assets/js/keywords.js"></script>

  </head>
  
  <body data-type="index">
	<?php include('../admin_config/admin_top.php');;?>
    <div class="tpl-page-container tpl-page-header-fixed">
	<?php include('../admin_config/admin_list.php');;?>
        <div class="tpl-content-wrapper">

            <ol class="am-breadcrumb">
                <li><a href="javascript:;" class="am-icon-home">首页</a></li>
                <li>其他设置</li>
                <li>站群管理-新增</li>
            </ol>
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 站群管理-新增
                    </div>
                </div>
                <div class="tpl-block ">

                    <div class="am-g tpl-amazeui-form">

                        <?php
                        $site_config = json_decode(file_get_contents(CMS_ROOT.'Basicsetup/site_config.json'),true);
                        $links_config = json_decode(file_get_contents(CMS_ROOT.'connection/connection.json'),true);
                        $siteGroup_config = CMS_ROOT.'qita/site_group.json';
                        if(isset($_POST['domains'])){
                            $json = json_decode(file_get_contents($siteGroup_config),true);
                            $data = $_POST;
                            $data['domains'] = explode('|',$data['domains']);
                            $data['video'] = explode(',',$data['video']);
                            $data['links'] = explode(',',$data['links']);
                            $key = time();
                            $data['id'] = $key;
                            $json[$key] = $data;
                            file_put_contents($siteGroup_config,json_encode($json));
                            exit('<script>alert("添加成功！");location.href="SiteGroup_list.php";</script>');
                        }
                        ?>
                        <div class="am-u-sm-12 am-u-md-9">
                            <form method="post"  class="am-form am-form-horizontal">

                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">网站域名</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" value="" name="domains" required placeholder="网站域名不带前缀如www.baidu.com填写baidu.com即可,多个域名用|分隔">
                                    </div>
                                </div>							
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">网站名称</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" value="" name="title" required placeholder="网站名称">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">关键字</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" value="" name="keywords" required placeholder="关键字">
                                        <a href="javascript:;" onclick="document.querySelector('input[name=keywords]').value=getKeywords();">
                                            <bas class="am-btn am-btn-primary">自动生成</bas>
                                        </a>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">关键描述</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" value="" name="description" required  placeholder="关键描述">
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <input type="hidden" name="video">
                                    <label for="user-phone"  class="am-u-sm-3 am-form-label">首页视频推荐 </label>
                                    <div class="am-u-sm-9 videos">
                                        <?php
                                        foreach ($data['video'] as $vid){
                                            foreach ($cms_menu['vod'] as $vod){
                                                if($vod['id']==$vid){
                                                    echo '<span data="'.$vid.'" class="cid'.$vid.'">'.$vod['name'].'</span>';
                                                }
                                            }
                                        }
                                        ?>

                                    </div>
                                    <div class="am-u-sm-9">
                                        <?php
                                        foreach ($cms_menu['vod'] as $vod){
                                            ?>
                                            <div style="display: inline-block">
                                                <input type="checkbox" class="checkbox-videos" id="<?php echo $vod['id'];?>" value="<?php echo $vod['id'];?>" <?php echo in_array($vod['id'],$data['video'])?'checked':'';?>><label for="<?php echo $vod['id'];?>"><?php echo $vod["name"];?></label>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
							
								<div class="am-form-group">
                                    <label for="user-phone"  class="am-u-sm-3 am-form-label">PC模板选择</label>
                                    <div class="am-u-sm-9">
                                        <select name="moban_pc" data-am-selected="{searchBox: 1}" >

<?php 
  $filesnames = scandir("../../template/");


	$bakpc = array();
foreach ($filesnames as $name) {
	 if(strpos($name,'.') !==false || strpos($name,'-') !==false ){
	}else{
		
		$bakpc[] =$name;


		
		

	}
}

		$pcsuiji=array_rand($bakpc);
		$pcsuiji=$bakpc[$pcsuiji];
		 echo	'<option value="'.$pcsuiji.'">'.$pcsuiji.'</option>';






  
 
foreach ($filesnames as $name) {
	 if(strpos($name,'.') !==false || strpos($name,'-') !==false ){
	}else{
		echo	'<option value="'.$name.'">'.$name.'</option>';
	}
}
?>										  

										</select> 

                                        <small>默认随机抽取可手动选择</small>
                                    </div>
								</div>
								<div class="am-form-group">
                                    <label for="user-phone"  class="am-u-sm-3 am-form-label">WAP模板选择 </label>
                                    <div class="am-u-sm-9">
                                        <select name="moban_wap" data-am-selected="{searchBox: 1}" >

<?php 
		$mosuiji=array_rand($bakpc);
		$mosuiji=$bakpc[$mosuiji];
		 echo	'<option value="'.$mosuiji.'">'.$mosuiji.'</option>';



  $filesnames = scandir("../../template/");
foreach ($filesnames as $name) {
	 if(strpos($name,'.') !==false || strpos($name,'-') !==false ){
	}else{
		echo	'<option value="'.$name.'">'.$name.'</option>';
	}
}
?>										  

										</select>
                                        <small>默认随机抽取可手动选择</small>
                                    </div>
								</div>	
								

                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">网站logoURL</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" value="<?php echo $site_config['logo'];?>" name="logo" required placeholder="网站logoURL">
                                    </div>
                                </div>
								
                                <div class="am-form-group">
                                    <label for="user-email" class="am-u-sm-3 am-form-label">广告邮箱</label>
                                    <div class="am-u-sm-9">
                                        <input type="email" value="<?php echo $site_config['email'];?>" name="email" required placeholder="广告邮箱">
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <input type="hidden" name="links">
                                    <label for="user-phone"  class="am-u-sm-3 am-form-label">友情链接 <input type="checkbox" class="selectAll">全选</label>

                                    <div class="am-u-sm-9 links">
                                        <?php
                                        foreach ($data['links'] as $vid){
                                            foreach ($links_config as $link){
                                                if($link['id']==$vid){
                                                    echo '<span data="'.$vid.'" class="cid'.$vid.'">'.$link['title'].'</span>';
                                                }
                                            }
                                        }
                                        ?>

                                    </div>
                                    <div class="am-u-sm-9">
                                        <?php
                                        foreach ($links_config as $link){
                                            ?>
                                            <div style="display: inline-block">
                                                <input type="checkbox" class="checkbox-links" id="<?php echo $link['id'];?>" value="<?php echo $link['id'];?>" <?php echo in_array($link['id'],$data['links'])?'checked':'';?>><label for="<?php echo $link['id'];?>"><?php echo $link["title"];?></label>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>


                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="name" name="submit" class="am-btn am-btn-primary">添加</button>
                                        <a href="SiteGroup_list.php" class="am-btn am-btn-primary">返回</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
			<?php include('../admin_config/admin_foot.php');?>
    </div>
	
    <script src="<?php echo CMS_ADMIN_url;?>assets/js/jquery.min.js"></script>
    <script src="<?php echo CMS_ADMIN_url;?>assets/js/amazeui.min.js"></script>
    <script src="<?php echo CMS_ADMIN_url;?>assets/js/iscroll.js"></script>
    <script src="<?php echo CMS_ADMIN_url;?>assets/js/app.js"></script>
    <script>
        window.onload=function(){
            $('.checkbox-videos').on('change',function (e) {
                if (this.checked){
                    $('.videos').append('<span data="'+this.value+'" class="cid'+this.value+'">'+$(this).next().text()+'</span>');
                }else{
                    $('.videos .cid'+this.value).remove();
                }
            });
            $('.checkbox-links').on('change',function (e) {
                if (this.checked){
                    $('.links').append('<span data="'+this.value+'" class="cid'+this.value+'">'+$(this).next().text()+'</span>');
                }else{
                    $('.links .cid'+this.value).remove();
                }
            });
            $('.selectAll').on('change',function (e) {
                if(this.checked){
                    $('.checkbox-links:not(:checked)').click();
                }else{
                    $('.checkbox-links:checked').click();
                }
            });
        }
        document.forms[0].onsubmit = function () {
            var videoArr = [];
            $('.videos span').each(function () {
                videoArr.push($(this).attr('data'));
            });
            $('input[name=video]').val(videoArr.join(','));

            var linkArr = [];
            $('.links span').each(function () {
                linkArr.push($(this).attr('data'));
            });
            $('input[name=links]').val(linkArr.join(','));
            return true;
        }
    </script>
  </body>

</html>