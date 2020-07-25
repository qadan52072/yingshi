<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2019/12/18
 * Time: 21:20
 */
if(IS_POST){
    $email = isset($_POST['email'])?$_POST['email']:'';
    $password = isset($_POST['password'])?$_POST['password']:'';
    if(!file_exists(CMS_ROOT.'users/'.$email.'.txt')){
        echo '<script>alert("邮箱地址不存在");history.go(-1)</script>';
    }else{
        $info = json_decode(file_get_contents(CMS_ROOT.'users/'.$email.'.txt'),true);
        if(md5('sdi%^&'.$password.'hfjs') != $info['key']){
            echo '<script>alert("登录密码不正确");history.go(-1)</script>';
        }else{
            $_SESSION['usermail'] = $email;
            echo '<script>alert("恭喜您登录成功！");location.href="/"</script>';
        }
    }
}
if($C_T_2=='logout'){
    unset($_SESSION['usermail']);
    header('location:'.U('user','login',1,1));
}
$tpl->assign('type_name','用户登录');
$plug->listen('login','before');
$tpl->show('login');
$plug->listen('login','after');