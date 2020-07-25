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
                <li>友链设置</li>
				<li>友链管理</li>
				 <li class="am-active">修改</li>
				 
            </ol>
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 修改
                    </div>
                </div>
                <?php
                $linkfile = CMS_ROOT."connection/connection.json";
                $json = json_decode(file_get_contents($linkfile),true);
                if(isset($_POST['title'])){

                    $data = $_POST;
                    $key = $_GET['id'];
                    $data['id'] = $key;
                    $json[$key] = $data;
                    file_put_contents($linkfile,json_encode($json));
                    exit('<script>alert("修改成功！");location.href="connection.php";</script>');
                }
                $tmp = $json[$_GET['id']];
                ?>
                <div class="tpl-block ">

                    <div class="am-g tpl-amazeui-form">


                        <div class="am-u-sm-12 am-u-md-9">
                            <form method="post"  class="am-form am-form-horizontal">
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">排序</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="sort"  value="<?php echo  $tmp['sort'];?>" placeholder="序号">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">友链标题</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="title"  value="<?php echo  $tmp['title'];?>" placeholder="友链标题">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">	友链地址URL</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="url"  value="<?php echo  $tmp['url'];?>" placeholder="友链地址URL">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">备注</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="remark"  value="<?php echo  $tmp['remark'];?>" placeholder="如12/8~1/8广告费100元">
                                    </div>
                                </div>								
                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button name="submit" type="submit" class="am-btn am-btn-primary">修改</button>
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