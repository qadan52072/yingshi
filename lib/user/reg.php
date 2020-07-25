<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2019/12/18
 * Time: 21:20
 */
$key = 'aHR0cHM6Ly93YW5nYmFnYW96aXpoZWJ1c2hpbmlnYWlrYW5kZS5jb20vc2VuZF9tYWlsLnBocA==';
if(IS_POST){
    if(IS_AJAX){
        header('Content-Type:text/json');
        $email = isset($_POST['email'])?$_POST['email']:'';
        $verifycode = isset($_POST['verifycode'])?$_POST['verifycode']:'';
        $code = rand('10000','99999');
        $_SESSION['mail'] = $email;
        $_SESSION['mail_code'] = $code;
        if(!file_exists(CMS_ROOT.'users/'.$email.'.txt')){
            !file_exists(CMS_ROOT.'users/')&&mkdir(CMS_ROOT.'users/');
            if(strtoupper($verifycode) == strtoupper($_SESSION['yzm'])){
                unset($_SESSION['yzm']);
                $ret = curl_post(base64_decode($key),'email='.$email.'&code='.$code);
                if($ret=='true'){
                    echo json_encode(['success'=>true]);
                }else{
                    echo json_encode(['success'=>false,'msg'=>'系统繁忙，请稍后再试']);
                }

            }else{
                echo json_encode(['success'=>false,'msg'=>'验证码不正确']);
            }
        }else{
            echo json_encode(['success'=>false,'msg'=>'邮箱已经被注册']);
        }

        exit();
    }else{
        $email = isset($_POST['email'])?$_POST['email']:'';
        $emailcode = isset($_POST['emailcode'])?$_POST['emailcode']:'';
        $password = isset($_POST['password'])?$_POST['password']:'';
        if($email!=$_SESSION['mail']){
            echo '<script>alert("邮箱地址不正确");history.go(-1)</script>';
        }else{
            if($emailcode!=$_SESSION['mail_code']){
                echo '<script>alert("邮箱验证码不正确");history.go(-1)</script>';
            }else{
                unset($_SESSION['mail_code']);
                file_put_contents(CMS_ROOT.'users/'.$email.'.txt',json_encode([
                    'key'=>md5('sdi%^&'.$password.'hfjs'),
                    'vip'=>0,
                    'create'=>time()
                ]));
                $_SESSION['usermail'] = $email;
                echo '<script>alert("恭喜您注册成功！");location.href="/"</script>';
            }
        }
    }
}

$tpl->assign('type_name','用户注册');
$plug->listen('reg','before');
$tpl->show('reg');
$plug->listen('reg','after');