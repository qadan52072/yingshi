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
                <li>广告设置</li>
				<li>头部横幅广告</li>
				 <li class="am-active">修改</li>
				 
            </ol>
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 修改
                    </div>
                </div>
<?php
$ad_top_json_url=CMS_ROOT."ad/ad_top/ad.json";
$json = json_decode(file_get_contents($ad_top_json_url),true);
if(isset($_POST['title'])){
    $data = $_POST;
    $data['endtime'] = strtotime($data['endtime']);
    $key = $_GET['id'];
    $data['id'] = $key;
    $json[$key] = $data;
    file_put_contents($ad_top_json_url,json_encode($json));
    exit('<script>alert("修改成功！");location.href="ad_top.php";</script>');
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
                                        <input type="text" name="sort" required value="<?php echo $tmp['sort'];?>" placeholder="排序">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">广告标题</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="title" value="<?php echo $tmp['title'];?>" required placeholder="广告标题">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">广告链接URL</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="url"  value="<?php echo $tmp['url'];?>" required placeholder="广告链接URL">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">	广告图片</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="pic"  value="<?php echo $tmp['pic'];?>" required placeholder="广告图片">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">	wap广告图片</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="pic_wap"  value="<?php echo $tmp['pic_wap'];?>" required  placeholder="wap广告图片">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">到期时间</label>
                                    <div class="am-u-sm-9">
                                        <div class="am-input-group am-datepicker-date" data-am-datepicker>
                                            <input type="text" class="am-form-field" placeholder="到期时间" name="endtime"  value="<?php echo date('Y-m-d',$tmp['endtime']);?>" required readonly>
                                            <span class="am-input-group-btn am-datepicker-add-on">
                                                <button class="am-btn am-btn-default" type="button"><span class="am-icon-calendar"></span> </button>
                                              </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button name="submit" type="submit" class="am-btn am-btn-primary">修改</button>
                                        <a href="ad_top.php" class="am-btn am-btn-primary">返回</a>
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