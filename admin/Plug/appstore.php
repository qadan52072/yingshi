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
                        <span class="am-icon-code"></span> 应用商店
                    </div>



                </div>
                <div class="tpl-block">
                    <div class="am-tabs" data-am-tabs="{noSwipe: 1}">
                        <ul class="am-tabs-nav am-nav am-nav-tabs">
                            <li class="am-active"><a href="javascript: void(0)">插件商店</a></li>
                            <li><a href="javascript: void(0)">模板商店</a></li>
                        </ul>

                        <div class="am-tabs-bd">
                            <div class="am-tab-panel am-active">
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
                                                $onlinePlug = json_decode(file_get_contents(CMS_API.'plug.php'),true);
                                                $filesnames = scandir(CMS_PLUG);
                                                foreach ($onlinePlug as $key => $item) {
                                                        ?>
                                                        <tr>
                                                            <td><a href="javascript:;"><?php echo $item['appid'];?></a></td>
                                                            <td><?php echo $item['appname'];?></td>
                                                            <td class="am-hide-sm-only"><?php echo $item['description'];?></td>
                                                            <td class="am-hide-sm-only"><?php echo $item['version'];?>版本-<?php echo $item['author'];?></td>
                                                            <td>
                                                                <div class="am-btn-toolbar">
                                                                    <div class="am-btn-group am-btn-group-xs">
                                                                        <!--已安装-->
                                                                        <?php if(in_array($key,$filesnames)){?>
                                                                            <?php $json = json_decode(file_get_contents(CMS_PLUG.$key.'/manifest.json'),true);?>
                                                                            <?php if($json['version']<$item['version']){var_dump(file_get_contents(CMS_PLUG.$key.'/manifest.json'));?>
                                                                                <a href="<?php echo './update.php?plug='.$key;?>" class="am-btn am-btn-success am-btn-xs"><span class="am-icon-refresh"></span> 更新</a>
                                                                            <?php }else{?>
                                                                                <a href="javascript:;" class="am-btn am-btn-default am-btn-xs" disabled="disabled"> 已安装&nbsp;</a>
                                                                            <?php }?>
                                                                        <?php }else{?>
                                                                            <!--未安装-->
                                                                            <a href="<?php echo './install.php?plug='.$key;?>" class="am-btn am-btn-success am-btn-xs"><span class="am-icon-link"></span> 安装</a>
                                                                        <?php }?>
                                                                        <a href="<?php echo $item['site'];?>" target="_blank" class="am-btn am-btn-secondary am-btn-xs _am-hide-sm-only"><span class="am-icon-cube"></span> 详细说明</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                }
                                                ?>





                                                </tbody>
                                            </table>
                                            <hr>

                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="am-tab-panel">
                                <div class="am-g">
                                    <?php
                                    $onlineTpl = json_decode(file_get_contents(CMS_API.'tpl.php'),true);
                                    $filesnames = scandir(CMS_TPL);
                                    foreach ($onlineTpl as $key => $item) {
                                    ?>
                                        <div class="am-u-sm-12 am-u-md-4 am-u-lg-3">
                                            <div class="am-thumbnail">
                                                <img src="<?php echo $item['preview'];?>" alt=""/>
                                                <h3 class="am-thumbnail-caption" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis"><?php echo $item['name'];?></h3>
                                                <div class="am-btn-toolbar">
                                                    <div class="am-btn-group am-btn-group-xs am-g" style="width: calc(100% - 5px);">
                                                        <div class="">
                                                        <!--已安装-->
                                                        <?php if(in_array($key,$filesnames)){?>
                                                            <a href="<?php echo './uninstall.php?tpl='.$key;?>" onclick="return confirm('是否要卸载此模板?')" class="am-btn am-btn-danger am-btn-xs am-u-sm-6 am-u-md-6"><span class="am-icon-unlink"></span> 卸载&nbsp;</a>
                                                        <?php }else{?>
                                                            <!--未安装-->
                                                            <a href="<?php echo './install.php?tpl='.$key;?>" class="am-btn am-btn-success am-btn-xs am-u-sm-6 am-u-md-6"><span class="am-icon-link"></span> 安装</a>
                                                        <?php }?>
                                                        <a href="<?php echo $item['site'];?>" target="_blank" class="am-btn am-btn-secondary am-btn-xs am-u-sm-6 am-u-md-6"><span class="am-icon-cube"></span> 详细说明</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
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