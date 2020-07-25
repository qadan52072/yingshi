<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2019/11/22
 * Time: 18:45
 */
include_once '../admin_config/config.php';
$plug = isset($_GET['plug'])?$_GET['plug']:'';
$tpl = isset($_GET['tpl'])?$_GET['tpl']:'';
if($plug!=''){
    if(file_exists(CMS_PLUG.$plug)){
        deldir(CMS_PLUG.$plug);
    }
    echo '卸载成功！';
    echo '<script>setTimeout(function() {
  location.href="./myplug.php";
},2000)</script>';

}elseif($tpl!=''){
    if(file_exists(CMS_TPL.$tpl)){
        deldir(CMS_TPL.$tpl);
    }
    echo '卸载成功！';
    echo '<script>setTimeout(function() {
  location.href="./appstore.php";
},2000)</script>';

}else{
    echo '<script>location.href="./myplug.php";</script>';
}