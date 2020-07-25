<?php include('../admin_config/config.php');?>
<?php include(CMS.'/lib/class/version.php');?>
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
	<?php include('../admin_config/admin_top.php');?>
    <div class="tpl-page-container tpl-page-header-fixed">
	<?php include('../admin_config/admin_list.php');?>
	<div class="tpl-content-wrapper">
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-pie-chart"></span> 站点统计
                </div>
            </div>
            <div class="tpl-block ">
                <ul class="am-g">
                    <li class="am-u-lg-3 am-u-md-6 am-u-sm-12">缓存目录：<?php echo round((directorySize(CMS.'/cache')/1048576),2);?>MB</li>
                    <li class="am-u-lg-3 am-u-md-6 am-u-sm-12">电影总量：<?php echo getCount('vod');?>部</li>
                    <li class="am-u-lg-3 am-u-md-6 am-u-sm-12">图片总量：<?php echo getCount('pic');?>页</li>
                    <li class="am-u-lg-3 am-u-md-6 am-u-sm-12">小说总量：<?php echo getCount('book');?>本</li>
                </ul>
            </div>
        </div>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-dashboard"></span> 服务器信息
                </div>
            </div>
            <div class="tpl-block ">
                <ul class="am-g">
                    <li class="am-u-lg-3 am-u-md-6 am-u-sm-12">操作系统：<?php echo PHP_OS;?></li>
                    <li class="am-u-lg-3 am-u-md-6 am-u-sm-12">服务器：<?php echo explode(' ',$_SERVER['SERVER_SOFTWARE'])[0];?></li>
                    <li class="am-u-lg-3 am-u-md-6 am-u-sm-12">PHP 版本：<?php echo PHP_VERSION;?></li>
                    <li class="am-u-lg-3 am-u-md-6 am-u-sm-12">内存上限：<?php echo ini_get('memory_limit');?></li>
                    <li class="am-u-lg-3 am-u-md-6 am-u-sm-12">目录权限：<?php echo substr(base_convert(fileperms(CMS),10,8),2,3);?></li>
                    <li class="am-u-lg-3 am-u-md-6 am-u-sm-12">ZIP状态：<?php echo in_array('zip', get_loaded_extensions())?'正常':'异常';?></li>
                    <li class="am-u-lg-3 am-u-md-6 am-u-sm-12">服务端IP：127.0.0.1</li>
                    <li class="am-u-lg-3 am-u-md-6 am-u-sm-12">客户端IP：127.0.0.1</li>
                    <li class="am-u-lg-3 am-u-md-6 am-u-sm-12">资源库版本：<?php echo file_get_contents(CMS.'/FH.DB');?></li>
                    <li class="am-u-lg-3 am-u-md-6 am-u-sm-12">磁盘剩余空间：<?php echo round((disk_free_space(CMS)/1073741824),2);?>GB</li>
                    <li class="am-u-lg-3 am-u-md-6 am-u-sm-12">是否开启远程URL：<?php echo ini_get('allow_url_fopen')?'是':'否';?></li>
                    <li class="am-u-lg-3 am-u-md-6 am-u-sm-12">最长执行时间：<?php echo ini_get('max_execution_time');?></li>
                </ul>
            </div>
        </div>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-info-circle"></span> 程序说明
                </div>
            </div>
            <div class="tpl-block ">
                <?php
                    $newVersion = json_decode(file_get_contents(CMS_API.'version.php'),true);
                ?>
                <p>版本号：<?php echo CMS_VERSION;?> <?php echo $newVersion['version']>CMS_VERSION?' [<span style="color: #FF2805">发现新版本 <a href="update.php" onclick="return confirm(\''.$newVersion['info'].'\')">点此更新</a></span>]':'';?></p>
                <p>此程序版权所有番号CMS WWW.FANHAOCMS.COM。请勿盗版。</p>
                <p>使用官网最新版本，提高建站体验和建站安全</p>
                <p>1.本系统所有资源均自动采集，无需人工，省时省力。新版架构重新配置</p>
                <p>2.影院自适应所有设备，PC/手机/pad均可使用。</p>
                <p>3.本系统不依托任何第三方CMS，纯PHP，对环境要求小，基本所有的PHP环境都可轻松带起。</p>
                <p>4.所有广告及版权信息均可从后台更改。</p>
                <p>官网电报群(纸飞机)： <a href="https://t.me/joinchat/J2SazxoF9szkLtvY8gizxg" target="_blank">点击加入</a></p>
                <p>番号CMS 关注X站站长发展,从快捷建站——引流变现，不懈努力！</p>
            </div>
        </div>

        <div class="am-u-md-6 am-u-sm-12 row-mb"></div>
      </div>
	<?php include('../admin_config/admin_foot.php');?>
    </div>
    <script src="<?php echo CMS_ADMIN_url;?>assets/js/jquery.min.js"></script>
    <script src="<?php echo CMS_ADMIN_url;?>assets/js/amazeui.min.js"></script>
    <script src="<?php echo CMS_ADMIN_url;?>assets/js/iscroll.js"></script>
    <script src="<?php echo CMS_ADMIN_url;?>assets/js/app.js"></script>
    <?php if(!file_exists(CMS_ROOT.'/admin_boss/core.php')){?>
        <script>alert('后台安全性能升级，请重新设置后台账号密码！');location.href='../admin_security/security_userpass.php';</script>
    <?php }?>
  </body>

</html>