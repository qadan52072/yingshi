<?php
include('../admin_config/config.php');
error_reporting(E_ALL^E_NOTICE^E_WARNING);
?>
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
                <li>扩展管理</li>
				
            </ol>
<div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 扩展管理
                    </div>



                </div>
                <div class="tpl-block">
                    <div class="am-g">



                        <div class="am-u-sm-12">
                            <form class="am-form">
                                <table class="am-table am-table-striped am-table-hover table-main">
                                    <thead>
                                        <tr>
                                            <th class="table-title">插件标识</th>
                                            <th class="table-type">插件名称</th>
                                            <th class="table-date am-hide-sm-only">插件功能</th>
											 <th class="table-date am-hide-sm-only">插件版本-作者</th>
                                            <th class="table-set">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody style="word-break: break-all;">	
									<?php 
									  $filesnames = scandir(CMS_PLUG);
										foreach ($filesnames as $name) {
											 if(file_exists(CMS_PLUG.'/'.$name.'/manifest.json')){
											     $file = file_get_contents(CMS_PLUG.'/'.$name.'/manifest.json');
											    $json = json_decode(trim($file,chr(239).chr(187).chr(191)),true)
												?>
                                                 <tr>
                                                     <td><a href="javascript:;"><?php echo $json['appid'];?></a></td>
                                                     <td><?php echo $json['appname'];?></td>
                                                     <td class="am-hide-sm-only"><?php echo $json['description'];?></td>
                                                     <td class="am-hide-sm-only"><?php echo $json['version'];?>版本-<?php echo $json['author'];?></td>
                                                     <td>
                                                         <div class="am-btn-toolbar">
                                                             <div class="am-btn-group am-btn-group-xs">
                                                                 <a href="<?php echo './setting.php?s='.$name.'/index.html';?>" class="am-btn am-btn-success am-btn-xs"><span class="am-icon-cog"></span> 设置</a>
                                                                 <a href="<?php echo './uninstall.php?plug='.$name;?>" onclick="return confirm('确定要卸载吗？')" class="am-btn am-btn-danger am-btn-xs"><span class="am-icon-unlink"></span> 卸载</a>
                                                             </div>
                                                         </div>
                                                     </td>
                                                 </tr>
                                                 <?php
											}
										}
									?>	





                                    </tbody>
                                </table>
                                <hr>

                            </form>
                        </div>

                    </div>
                </div>
                <div class="tpl-alert"></div>
            </div>        </div>
				<?php include('../admin_config/admin_foot.php');?>
    </div>
	
    <script src="<?php echo CMS_ADMIN_url;?>assets/js/jquery.min.js"></script>
    <script src="<?php echo CMS_ADMIN_url;?>assets/js/amazeui.min.js"></script>
    <script src="<?php echo CMS_ADMIN_url;?>assets/js/iscroll.js"></script>
    <script src="<?php echo CMS_ADMIN_url;?>assets/js/app.js"></script>
  </body>

</html>