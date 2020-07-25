<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
$CMS_ADMIN_href='http://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
define('CMS_ADMIN_href',$CMS_ADMIN_href);
$CMS_ADMIN_url='../';
define('CMS_ADMIN_url',$CMS_ADMIN_url);
define('CMS_ROOT',$_SERVER['DOCUMENT_ROOT'].'/config/');
define('CMS_BOSS',CMS_ROOT.'admin_boss/boss.php');



	
?>