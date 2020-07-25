<?php
//需要替换的
$this->subjects[] = "/$this->left\s*(cms_banner_a)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(cms_banner_b)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(cms_search)\s*$this->right/";
$this->subjects[] = "/$this->left\s*key\s*:\s*(.*?)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(cms_tj)\s*$this->right/";

$this->subjects[] = "/$this->left\s*(video_menu)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(hd_menu)\s*$this->right/";
$this->subjects[] = "/$this->left\s*\/(video_menu|hd_menu)\s*$this->right/";

$this->subjects[] = "/$this->left\s*(book_menu)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(pic_menu)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(live_menu)\s*$this->right/";

$this->subjects[] = "/$this->left\s*(menu_link)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(menu_name)\s*$this->right/";
$this->subjects[] = "/$this->left\s*:(.*?)\s*\((.*?)\)\s*$this->right/";
$this->subjects[] = "/$this->left\s*\/(book_menu|pic_menu|live_menu)\s*$this->right/";
//替换后的
$this->replaces[] = <<<tag
<?php cms_banner_a('<a href="链接"  target="_blank"  ><img style="width:100%;margin-bottom:2px;" src="图片"></a>');?>
tag;
$this->replaces[] = <<<tag
<?php cms_banner_b('<a href="链接" target="_blank"><img style="width:100%;margin-bottom:2px;" src="图片"></a>');?>
tag;
$this->replaces[] = <<<tag
<input type="hidden" name="s" value="<?php echo 'search'.\$cms_config['url_split'].'type'.\$cms_config['url_split'].'so'.\$cms_config['url_split'].'1.'.\$cms_config['url_file']; ?>"/>
tag;
$this->replaces[] = <<<tag
<?php echo U('search','type',\\1,'1');?>
tag;
$this->replaces[] = <<<tag
<?php 
include('./class/class_ad_Popup.php');
include('./class/cllass_ad_js.php');
include('./class/class_ad_float.php');
include('./class/class_statistics.php');
?>
tag;

$this->replaces[] = <<<tag
<?php foreach (\$cms_menu['vod'] as \$item){ \$menu_type='vod';\$menu_id=\$item['id'];if (\$item['hd'] == '0'){?>
tag;
$this->replaces[] = <<<tag
<?php foreach (\$cms_menu['vod'] as \$item){ \$menu_type='vod';\$menu_id=\$item['id'];if (\$item['hd'] == '1'){?>
tag;
$this->replaces[] = <<<tag
<?php }}?>
tag;

$this->replaces[] = <<<tag
<?php foreach (\$cms_menu['book'] as \$item){ \$menu_type='book';\$menu_id=\$item['id'];?>
tag;
$this->replaces[] = <<<tag
<?php foreach (\$cms_menu['pic'] as \$item){ \$menu_type='pic';\$menu_id=\$item['id'];?>
tag;
$this->replaces[] = <<<tag
<?php foreach (\$cms_menu['live'] as \$item){ \$menu_type='live';\$menu_id=\$item['id'];?>
tag;

$this->replaces[] = <<<tag
<?php echo U(\$menu_type,'type',\$menu_id,'1');?>
tag;
$this->replaces[] = <<<tag
<?php echo \$item['name']?>
tag;
$this->replaces[] = <<<tag
<?php echo \\1(\\2);?>
tag;
$this->replaces[] = <<<tag
<?php }?>
tag;
require 'smTagIndex.php';
require 'smTagType.php';
require 'smTagPage.php';