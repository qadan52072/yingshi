<?php include('../admin_config/config.php');?>
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

  </head>
  
  <body data-type="index">
	<?php include('../admin_config/admin_top.php');;?>
    <div class="tpl-page-container tpl-page-header-fixed">
	<?php include('../admin_config/admin_list.php');;?>
        <div class="tpl-content-wrapper">

            <ol class="am-breadcrumb">
                <li><a href="javascript:;" class="am-icon-home">首页</a></li>
                <li>系统设置</li>
                <li>基本设置</li>
            </ol>
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 基本设置
                    </div>
                </div>
                <div class="tpl-block ">

                    <div class="am-g tpl-amazeui-form">
<?php
$_config_file = CMS_ROOT."Basicsetup/site_config.json";
error_reporting(E_ALL^E_NOTICE^E_WARNING);
header("Content-type: text/html; charset=utf-8");
$json = json_decode(file_get_contents($_config_file),true);
if(isset($_POST['moban_pc'])){
    file_put_contents($_config_file,json_encode($_POST));
    exit('<script>alert("修改成功！");history.go(-1);</script>');
}
?>	

                        <div class="am-u-sm-12 am-u-md-9">
                            <form method="post"  class="am-form am-form-horizontal">

                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">网站名称</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" value="<?php echo $json['title'];?>" name="title" placeholder="网站名称">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">关键字</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" value="<?php echo $json['keywords'];?>" name="keywords" placeholder="关键字">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">关键描述</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" value="<?php echo $json['description'];?>" name="description" placeholder="关键描述">
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-phone"  class="am-u-sm-3 am-form-label">PC模板选择 </label>
                                    <div class="am-u-sm-9">
                                        <select name="moban_pc" data-am-selected="{searchBox: 1}" >
                                            <option value="<?php echo $json['moban_pc'];?>">目前模板：<?php echo $json['moban_pc'];?></option>
                                            <?php
                                            $filesnames = scandir("../../template/");
                                            foreach ($filesnames as $name) {
                                                if(strpos($name,'.') !==false || strpos($name,'-') !==false ){
                                                }else{
                                                    echo	'<option value="'.$name.'">'.$name.'</option>';
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-phone"  class="am-u-sm-3 am-form-label">WAP模板选择 </label>
                                    <div class="am-u-sm-9">
                                        <select name="moban_wap" data-am-selected="{searchBox: 1}" >
                                            <option value="<?php echo $json['moban_wap'];?>">目前模板：<?php echo $json['moban_wap'];?></option>
                                            <?php
                                            $filesnames = scandir("../../template/");
                                            foreach ($filesnames as $name) {
                                                if(strpos($name,'.') !==false || strpos($name,'-') !==false ){
                                                }else{
                                                    echo	'<option value="'.$name.'">'.$name.'</option>';
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">网站logoURL</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" value="<?php echo $json['logo'];?>" name="logo" placeholder="网站logoURL">
                                    </div>
                                </div>
								
                                <div class="am-form-group">
                                    <label for="user-email" class="am-u-sm-3 am-form-label">广告邮箱</label>
                                    <div class="am-u-sm-9">
                                        <input type="email" value="<?php echo $json['email'];?>" name="email" placeholder="广告邮箱">
                                    </div>
                                </div>


                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="name" name="submit" class="am-btn am-btn-primary">保存修改</button>
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
  </body>

</html>