<?php
//需要替换的
$this->subjects[] = "/$this->left\s*(cms_link)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(video_hot)\s*$this->right/";
$this->subjects[] = "/$this->left\s*live_hot_list\s*:\s*([1-9][0-9]*)\s*$this->right/";
$this->subjects[] = "/$this->left\s*\/(video_hot|live_hot_list)\s*$this->right/";
//替换后的
$this->replaces[] = <<<tag
<?php ulink('<a class="text-sub-title mx-2 text-small" href="链接" target="_blank" style="margin:0 10px;">标题</a>');?>
tag;
$this->replaces[] = '<?php foreach (\$cms_config[\'video\'] as \$item){ \$type_name=getTypeById(\'vod\',\$item);\$type_more=U(\'vod\',\'type\',\$item,\'1\');\$data=getListByType(\'vod\',\$item,true);\$page=1;?>';


$this->replaces[] = <<<tag
<?php
\$json_string = file_get_contents(\$liveapi);
\$data = json_decode(\$json_string, true);
\$datas = \$data['fileinfo'];
\$pageresult = \$data['pageresult'];
\$page = \$data['page'];
\$type_name=getTypeById('live',\$cms_config['live']);
\$type_more=U('live','type',\$cms_config['live'],'1');
foreach (\$datas as \$key=>\$val) {
if(\$key==\\1)break;
\$view= U('live','view',base64_encode(\$cms_config['live'].'|'.\$val['name']),base64_encode(\$val['m3u8']));
\$name=\$val['name'];
\$pic=\$val['pic'];
\$hit = rand(5, 10000);
\$time = date('Y-m-d');
?>
tag;

$this->replaces[] = '<?php }?>';

?>