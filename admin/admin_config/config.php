<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
 $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';

$CMS_ADMIN_url=$http_type.$_SERVER['HTTP_HOST'].'/';
define('CMS_ADMIN_url',$CMS_ADMIN_url);
$SELFPATH = explode('/',$_SERVER['PHP_SELF']);
define('CMS_ADMIN','/'.$SELFPATH[1].'/');
define('CMS',$_SERVER['DOCUMENT_ROOT']);
define('CMS_ROOT',CMS.'/config/');
define('CMS_PLUG',CMS.'/Plug/');
define('CMS_TPL',CMS.'/template/');
define('CMS_BOSS',CMS_ROOT.'admin_boss/boss.php');
define('CMS_API','http://api.fanhaocms.net/');
define('IS_AJAX',$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest');
define('IS_POST',$_SERVER['REQUEST_METHOD'] == 'POST');
define('IS_GET',$_SERVER['REQUEST_METHOD'] == 'GET');

session_start();
include(CMS_BOSS);
if ($_SESSION['username'] == NULL && $_SESSION['username'] != USERNAME) {
	
header("Location: ../index.php");exit();	
}
if ($_SESSION['password'] == NULL && $_SESSION['password'] != PASSWORD ) {
header("Location: ../index.php");exit();	
}
if(is_array($_GET)&&count($_GET)>0)//先判断是否通过get传值了
    {
        if(isset($_GET["err"]))//是否存在"id"的参数
        {
            $err=$_GET["err"];//存在
			if($err == 1){
				session_destroy();
				header("Location: ../index.php");exit();	
			}
        }
    }

function directorySize($directory){
    $directorySize = 0;
    //打开目录读取其内容
    if($dh = @opendir($directory)){
        //迭代处理每个目录项
        while(($filename=readdir($dh))){
            //过滤掉一些目录项
            if($filename !="." && $filename !=".."){
                //文件确定大小并添加总大小
                if(is_file($directory."/".$filename)){
                    $directorySize+=filesize($directory."/".$filename);
                }
                //新目录，开始递归
                if(is_dir($directory."/".$filename)){
                    $directorySize += directorySize($directory."/".$filename);
                }
            }
        }
    }
    @closedir($dh);
    return $directorySize;
}
function getCount($type){
    $data = file(CMS.'/data/db/'.$type.'.db');
    return sizeof($data);
}
function deldir($dir) {
	//先删除目录下的文件：
	$dh = opendir($dir);
	while ($file = readdir($dh)) {
		if($file != "." && $file!="..") {
		$fullpath = $dir."/".$file;
		if(!is_dir($fullpath)) {
			unlink($fullpath);
		} else {
			deldir($fullpath);
		}
		}
	}
	closedir($dh);

	//删除当前文件夹：
	if(rmdir($dir)) {
		return true;
	} else {
		return false;
	}
}
function ajaxReturn($json){
    header('Content-Type:text/json');
    echo json_encode($json);
}
?>

