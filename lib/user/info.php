<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2019/12/18
 * Time: 21:20
 */
if(!isset($_SESSION['usermail'])){
    header('location:'.U('user','login',1,1));
}
if(IS_AJAX){
    $cz = isset($_POST['cz'])?$_POST['cz']:'';
    $result['success'] = false;
    if($cz!=''){
        switch ($cz){
            case 'changepwd':
                $newpwd = isset($_POST['newpwd'])?$_POST['newpwd']:'';
                if($newpwd!=''&&strlen($newpwd)>=6){
                    $filepath = CMS_ROOT.'users/'.$_SESSION['usermail'].'.txt';
                    $old = json_decode(file_get_contents($filepath),true);
                    $old['key'] = md5('sdi%^&'.$newpwd.'hfjs');
                    file_put_contents($filepath,json_encode($old));
                    $result['success'] = true;
                }else{
                    $result['msg'] = '密码格式不正确';
                }
                break;
            case 'vip':
                $cardkey = isset($_POST['cardkey'])?$_POST['cardkey']:'';
                if($cardkey!=''&&strlen($cardkey)>=6){
                    $cardpath = CMS_ROOT.'cards/'.md5('uigw^&'.$cardkey.'%JGKJH');
                    if(file_exists($cardpath)){
                        $filepath = CMS_ROOT.'users/'.$_SESSION['usermail'].'.txt';
                        $old = json_decode(file_get_contents($filepath),true);
                        $old['vip'] = $old['vip']>time()?$old['vip']+2592000:time()+2592000;
                        file_put_contents($filepath,json_encode($old));
                        unlink($cardpath);
                        !file_exists(CMS_ROOT.'orders/')&&mkdir(CMS_ROOT.'orders/');
                        $orderpath = CMS_ROOT.'orders/'.$cardkey."-".time();
                        file_put_contents($orderpath,$_SESSION['usermail']);
                        $result['success'] = true;
                    }else{
                        $result['msg'] = '卡密不存在或已使用';
                    }
                }else{
                    $result['msg'] = '卡密格式不正确';
                }
                break;
        }
    }
    header('Content-Type:text/json');
    echo json_encode($result);
    exit();
}
$tpl->assign('type_name','用户信息');
$tpl->assign('email',$_SESSION['usermail']);
$tpl->assign('userinfo',json_decode(file_get_contents(CMS_ROOT.'users/'.$_SESSION['usermail'].'.txt'),true));
$plug->listen('info','before');
$tpl->show('info');
$plug->listen('info','after');