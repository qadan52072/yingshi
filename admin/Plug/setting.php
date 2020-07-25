<?php require '../admin_config/config.php';?>
<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
$s = isset($_GET['s'])?$_GET['s']:'';

if($s==''){
    header('location:./');
    exit();
}
$args = explode('.',$s)[0];
$args = explode('/',$args);
if(sizeof($args)<2){
    header('location:./');
    exit();
}
$name = $args[0];
$function = $args[1];
function plugDB($filename){
    global $name;
    return CMS_PLUG.$name.'/Plug_CMSDB/'.$filename;
}
function plugUrl($function,$args=[]){
    global $name;
    $params = [];
    $param = '';
    foreach ($args as $key=>$arg){
        array_push($params,$key.'='.$arg);
    }
    if(sizeof($params)>0){
        $param = '&'.implode('&',$params);
    }
    return './setting.php?s='.$name.'/'.$function.'.html'.$param;
}
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



    <?php
        include(CMS_PLUG.$name.'/Plug_admin/'.$function.'.php');
        include('../admin_config/admin_foot.php');
    ?>
</div>


<script src="<?php echo CMS_ADMIN_url;?>assets/js/jquery.min.js"></script>
<script src="<?php echo CMS_ADMIN_url;?>assets/js/amazeui.min.js"></script>
<script src="<?php echo CMS_ADMIN_url;?>assets/js/iscroll.js"></script>
<script src="<?php echo CMS_ADMIN_url;?>assets/js/app.js"></script>
</body>

</html>