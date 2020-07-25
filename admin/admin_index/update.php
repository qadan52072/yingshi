<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2019/11/24
 * Time: 19:59
 */
require_once '../admin_config/config.php';
require_once CMS.'/lib/class/version.php';
$newVersion = json_decode(file_get_contents(CMS_API.'version.php'),true);
$PATH_SELF = explode('/',$_SERVER["PHP_SELF"]);
$admin_path = $PATH_SELF[sizeof($PATH_SELF)-3];
if(IS_AJAX){
    $result = [
        'success'=>false
    ];
    if ($newVersion['version']>CMS_VERSION){
        $url = $newVersion['package'];
        $package = file_get_contents($url);
        file_put_contents(CMS.'/cache/update.zip',$package);
        $zip = new ZipArchive();
        $zip->open(CMS.'/cache/update.zip');
        $zip->extractTo(CMS);
        $zip->close();
        $result['success'] = true;


        $zip->open(CMS.'/kadmin.zip');
        $zip->extractTo(CMS.'/'.$admin_path);
        $zip->close();
        unlink(CMS.'/kadmin.zip');
    }else{
        $result['msg'] = '当前已经是最新版本，无需更新';
    }
    $result['url'] = './index.php';
    ajaxReturn($result);
}else{
    require_once '../admin_config/loading.php';
}
