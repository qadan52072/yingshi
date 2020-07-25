<?php include('./admin_config/cn.php');
require_once(CMS_BOSS);
if(IPPASS != NULL && IPPASS != '' && IPPASS != $_SERVER["REMOTE_ADDR"]){
    header('status:404');
    exit();
}
session_start();

if(isset($_SESSION['username'])) {
    header("Location: ./admin_index/");exit();
}else{

}
?>









    <!doctype html>
    <html  class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>后台登录-X-admin2.2</title>
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="stylesheet" href="<?php echo CMS_ADMIN_url;?>/assets/fh/css/font.css">
        <link rel="stylesheet" href="<?php echo CMS_ADMIN_url;?>/assets/fh/css/login.css">
        <link rel="stylesheet" href="<?php echo CMS_ADMIN_url;?>/assets/fh/css/xadmin.css">
        <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <!--[if lt IE 9]>
        <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
        <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-bg">

    <div class="login layui-anim layui-anim-up">
        <div class="message">番号CMS管理登录</div>
        <div id="darkbannerwrap"></div>

        <form method="post" action="dologin.php" class="layui-form" >
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <div class='validation' style="position:relative">
                <input name="yzm" lay-verify="required" placeholder="验证码"  type="password" class="layui-input">
                <img src="./admin_config/yzm.php" onClick="this.src='./admin_config/yzm.php?nocache='+Math.random()" class="code" style="height: 48px; width: 120px;position:absolute;right: 1px;top: 1px"/>
            </div>
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

    <!-- 底部结束 -->
    </body>
    </html>
<?php
$PATH_SELF = explode("/",$_SERVER["PHP_SELF"]);
$MODULE = $PATH_SELF[sizeof($PATH_SELF)-2];
if($MODULE=="admin"||$MODULE=="kadmin"){
    echo'<script language="javascript"> alert("您当前后台目录容易暴露，请尽快修改后台路径");  </script>';
}
?>