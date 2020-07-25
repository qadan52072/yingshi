<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2019/11/22
 * Time: 18:45
 */
require_once '../admin_config/config.php';
$plug = isset($_GET['plug'])?$_GET['plug']:'';
$tpl = isset($_GET['tpl'])?$_GET['tpl']:'';
if($plug!=''){
    if(IS_AJAX){

        $result = [
            'success'=>false
        ];
        if (file_exists(CMS_PLUG.$plug)){
            $result['msg'] = '插件已存在,请不要重复安装插件';
        }else{
            $appinfo  = json_decode(file_get_contents(CMS_API.'plug.php'),true);
            $appinfo = $appinfo[$plug];
            $url = $appinfo['package'];
            $package = file_get_contents($url);
            file_put_contents(CMS.'/cache/'.$plug.'.zip',$package);
            $zip = new ZipArchive();
            $zip->open(CMS.'/cache/'.$plug.'.zip');
            $zip->extractTo(CMS_PLUG);
            $zip->close();
            $result['success'] = true;
        }
        $result['url'] = './appstore.php';
        ajaxReturn($result);
    }else{
            require_once '../admin_config/loading.php';
    }
}elseif($tpl!=''){
    if(IS_AJAX){

        $result = [
            'success'=>false
        ];
        if (file_exists(CMS_TPL.$tpl)){
            $result['msg'] = '模板已存在,请不要重复安装模板';
        }else{
            $appinfo  = json_decode(file_get_contents(CMS_API.'tpl.php'),true);
            $appinfo = $appinfo[$tpl];
            $url = $appinfo['package'];
            $package = file_get_contents($url);
            file_put_contents(CMS.'/cache/'.$tpl.'.zip',$package);
            $zip = new ZipArchive();
            $zip->open(CMS.'/cache/'.$tpl.'.zip');
            $zip->extractTo(CMS_TPL);
            $zip->close();
            $result['success'] = true;
        }
        $result['url'] = './appstore.php';
        ajaxReturn($result);
    }else{
        require_once '../admin_config/loading.php';
    }
}else{
    echo '<script>location.href="./myplug.php";</script>';
}
