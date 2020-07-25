<?php

include('./admin_config/cn.php');
if (isset($_POST['username'])&& isset($_POST['password'])&& isset($_POST['yzm']) ) {
    function post_input($data){$data = stripslashes($data);$data = htmlspecialchars($data);return $data;}
    $username = post_input($_POST["username"]);
    $password = post_input($_POST["password"]);
    $yzm = post_input($_POST["yzm"]);
    require_once(CMS_BOSS);
    session_start();
    if(IPPASS != NULL){
        if(IPPASS != $_SERVER["REMOTE_ADDR"]){
            echo'<script language="javascript"> alert("您的IP为外来入侵者不在IP白名单内！无法访问！"); window.location.href="/" </script>';exit();
        }
    }
    if($_SESSION['lock'] >= '3'){
        file_put_contents('../lock.lock','');
        unset($_SESSION['lock']);

    }
    $file = "../lock.lock";

    if(file_exists($file))
    {
        echo'<script language="javascript"> alert("三次错误进入安全模式，请删除根目录lock.lock文件，恢复正常使用。"); window.location.href="/" </script>';exit();
    }
    else
    {

    }





    if(USERNAME != $username){
        echo'<script language="javascript"> alert("账号错误"); history.go(-1) </script>';$_SESSION['lock']=$_SESSION['lock']+1;exit();
    }
    if(PASSWORD != $password){
        echo'<script language="javascript"> alert("密码错误"); history.go(-1) </script>';$_SESSION['lock']=$_SESSION['lock']+1;exit();
    }
    if(strtoupper($_SESSION['yzm']) != strtoupper($yzm)){
        echo'<script language="javascript"> alert("验证码错误"); history.go(-1) </script>';$_SESSION['lock']=$_SESSION['lock']+1;exit();
    }

    if(USERNAME == 'CMS'){
        echo'<script language="javascript"> alert("您当前使用的是默认账号！请尽早修改默认账号换上更加复杂的账号，避免被有心人入侵"); </script>';
    }elseif(PASSWORD == 'CMS'){
        echo'<script language="javascript"> alert("您当前使用的是默认密码！请尽早修改默认密码换上更加复杂的密码，避免被有心人入侵");  </script>';
    }elseif (USERNAME==PASSWORD){
        echo'<script language="javascript"> alert("您当前使用的账号和密码相同，请修改提高安全级别");  </script>';
    }



    $_SESSION['username']=$username;$_SESSION['password']=$password;
    $ad_top_json_url=$_SERVER['DOCUMENT_ROOT']."/config/Basicsetup/Journal.php";
    header("Content-type: text/html; charset=utf-8");
    include('../class/class_txttest.php');
    $txt = new  TxtDB($ad_top_json_url);
    $bankinfo = array();
    $bankinfo["ad_top_id"] = time();;
    $bankinfo["ad_top_url"] = '127.0.0.1';
    $bankinfo["ad_top_pic"] = '';
    $bankinfo["ad_top_md"] = '';
    $txt::insert($bankinfo);  //增
    echo'<script language="javascript">  window.location.href="admin_index" </script>';

}
?>