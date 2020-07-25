<?php
set_time_limit(0);   //设置运行时间
error_reporting(E_ALL & ~E_NOTICE);  //显示全部错误
define('ROOT_PATH', dirname(dirname(__FILE__)));  //定义根目录
if(function_exists('date_default_timezone_set')){
	date_default_timezone_set('Asia/Shanghai');
}
input($_GET);
input($_POST);
function input(&$data){
	foreach ((array)$data as $key => $value) {
		if(is_string($value)){
			if(!get_magic_quotes_gpc()){
				$value = htmlentities($value, ENT_NOQUOTES);
                $value = addslashes(trim($value));
			}
		}else{
			$data[$key] = input($value);
		}
	}
}
//判断是否安装过程序
if(is_file('lock') && $_GET['step'] != 4){
	@header("Content-type: text/html; charset=UTF-8");
    echo "系统已经安装过了，如果要重新安装，那么请删除install目录下的lock文件";
    exit;
}

$html_title = '程序安装向导';
$html_header = <<<EOF
<div class="header">
  <div class="layout">
    <div class="title">
     
      <h2>番号CMS安装向导</h2>
     
    </div>
    <div class="version">版本: V1.0</div>
  </div>
</div>
EOF;

$html_footer = <<<EOF
<div class="footer">
  <h5>Powered by <font class="blue">番号CMS</font><font class="orange"></font></h5>
  <h6>版权所有 2020 &copy; <a href="http://www.fanhaocms.com" target="_blank">番号CMS</a></h6>
</div>
EOF;

if(!is_dir(ROOT_PATH.'/cache')){
    mkdir(ROOT_PATH.'/cache');
}

require('./include/function.php');
if(!in_array($_GET['step'], array(1,2,3,4,5))){
	$_GET['step'] = 0;
}
session_start();
switch ($_GET['step']) {
	case 1:
		require('./include/var.php');
		env_check($env_items);
        dirfile_check($dirfile_items);
        function_check($func_items);
		break;
	case 2:
		$install_error = '';
        step3($install_error);
        break;
	case 3:
        if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
            $m = isset($_POST['m'])?$_POST['m']:'';
            switch ($m){
                case 'rename':
                    $admin_path = $_SESSION['admin_path'];
                    rename(ROOT_PATH.'/fhadmin',ROOT_PATH.'/'.$admin_path);
                    echo 'success';
                    break;
                case 'config':
                    $admin = $_SESSION['admin'];
                    $password = $_SESSION['password'];
                    $sitename = $_SESSION['sitename'];

                    $str = '';
                    $str .= '<?php';
                    $str .= "\n";
                    $str .= '//后台密码';
                    $str .= "\n";
                    $str .= 'define(\'USERNAME\', \''.$admin.'\');';
                    $str .= "\n";
                    $str .= 'define(\'PASSWORD\', \''.$password.'\');';
                    $str .= "\n";
                    $str .= 'define(\'IPPASS\', \'\');';
                    $str .= "\n";
                    $str .= '?>';
                    file_put_contents(ROOT_PATH.'/config/admin_boss/boss.php',$str);
                    $siteConfigFile = ROOT_PATH.'/config/Basicsetup/site_config.json';
                    $siteConfig = json_decode(file_get_contents($siteConfigFile),true);
                    $siteConfig['title'] = $sitename;
                    $siteConfig['moban_pc'] = 'default';
                    $siteConfig['moban_wap'] = 'default';
                    file_put_contents($siteConfigFile,json_encode($siteConfig));
                    echo 'success';
                    break;
                case 'finish':
                    $fp = @fopen('lock','w+');
                    @fclose($fp);
                    require_once ROOT_PATH.'/lib/class/Update.php';
                    break;
                default:
                    break;
            }
            exit();
        }
		break;
	case 4:
		$sitepath = strtolower(substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')));
        $sitepath = str_replace('install',"",$sitepath);
        $auto_site_url = strtolower('http://'.$_SERVER['HTTP_HOST'].$sitepath);
		break;
	default:
		# code...
		break;
}

include ("step_{$_GET['step']}.php");

function step3(&$install_error){
    global $html_title,$html_header,$html_footer;
    if ($_POST['submitform'] != 'submit') return;
    $admin_path = $_POST['admin_path'];
    $admin = $_POST['admin'];
    $password = $_POST['password'];
    $sitename = $_POST['site_name'];
    if ( !$admin_path || !$admin || !$password){
        $install_error = '输入不完整，请检查';
    }

    if ($admin_path!='kadmin'&&file_exists(ROOT_PATH.'/'.$admin_path)){
        $install_error .= '后台目录名称已存在，请检查';
    }

    if(strlen($admin) > 15 || preg_match("/^$|^c:\\con\\con$|　|[,\"\s\t\<\>&]|^游客|^Guest/is", $admin)) {
        $install_error .= '非法用户名，用户名长度不应当超过 15 个英文字符，且不能包含特殊字符，一般是中文，字母或者数字';
    }

    if ($install_error != ''){
        echo $install_error;
        return;
    }
    session_start();
    $_SESSION['admin_path'] = $admin_path;
    $_SESSION['admin'] = $admin;
    $_SESSION['password'] = $password;
    $_SESSION['sitename'] = $sitename;
    header('location:./index.php?step=3');
}