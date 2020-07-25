<?php
//需要替换的
$this->subjects[] = "/$this->left\s*(video_list|pic_list|book_list)\s*:\s*([1-9][0-9]*)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(type_list)\s*:\s*(vod|pic|book)\s*,\s*([1-9][0-9]*)\s*,\s*([1-9][0-9]*)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(new_list)\s*:\s*(vod|pic|book)\s*,\s*([1-9][0-9]*)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(rand_list)\s*:\s*(vod|pic|book)\s*,\s*([1-9][0-9]*)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(live_list)\s*:\s*([1-9][0-9]*)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(list_view)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(list_detail)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(list_name)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(list_pic)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(list_hit)\s*$this->right/";
$this->subjects[] = "/$this->left\s*(list_time)\s*$this->right/";
$this->subjects[] = "/$this->left\s*\/(video_list|pic_list|book_list|type_list|new_list|rand_list)\s*$this->right/";
$this->subjects[] = "/$this->left\s*\/(live_list)\s*$this->right/";

//替换后的
$this->replaces[] = <<<tag
<?php 
\$pagecount = floor(count(\$data) / \\2);
\$controller = \$cms_controller;
if(\$cms_controller=='search'||\$cms_controller=='index'){
\$controller = 'vod';
}
if( \$data ==null){
echo "<p>没有查询到你要查找的数据</p>";
}else{
for(\$x=(\$page-1) * \\2;\$x<(\$page-1) * \\2 + \\2;\$x++){ 
if(getValueByKey(\$data,\$x,'id')=='')break;
\$view = U(\$controller,'view','id',getValueByKey(\$data,\$x,'id'));
\$detail = U(\$controller,'detail','id',getValueByKey(\$data,\$x,'id'));
\$name = getValueByKey(\$data,\$x,'name');
\$pic = getValueByKey(\$data,\$x,'pic');
\$hit = rand(5, 10000);
\$time = getValueByKey(\$data,\$x,'time');
?>
tag;

$this->replaces[] = <<<tag
<?php 
\$typelist_data = getListByType('\\2',\\3,false,\\4);
if( \$typelist_data ==null){
echo "<p>没有查询到你要查找的数据</p>";
}else{
for(\$x=0;\$x< \\4;\$x++){ 
if(getValueByKey(\$typelist_data,\$x,'id')=='')break;
\$view = U('\\2','view','id',getValueByKey(\$typelist_data,\$x,'id'));
\$detail = U('\\2','detail','id',getValueByKey(\$typelist_data,\$x,'id'));
\$name = getValueByKey(\$typelist_data,\$x,'name');
\$pic = getValueByKey(\$typelist_data,\$x,'pic');
\$hit = rand(5, 10000);
\$time = getValueByKey(\$typelist_data,\$x,'time');
?>
tag;

$this->replaces[] = <<<tag
<?php 
\$newlist_data = getListByNew('\\2',\\3);
if( \$newlist_data ==null){
echo "<p>没有查询到你要查找的数据</p>";
}else{
for(\$x=0;\$x< \\3;\$x++){ 
if(getValueByKey(\$newlist_data,\$x,'id')=='')break;
\$view = U('\\2','view','id',getValueByKey(\$newlist_data,\$x,'id'));
\$detail = U('\\2','detail','id',getValueByKey(\$newlist_data,\$x,'id'));
\$name = getValueByKey(\$newlist_data,\$x,'name');
\$pic = getValueByKey(\$newlist_data,\$x,'pic');
\$hit = rand(5, 10000);
\$time = getValueByKey(\$newlist_data,\$x,'time');
?>
tag;

$this->replaces[] = <<<tag
<?php 
\$randlist_data = getListByRand('\\2',\\3);
if( \$randlist_data ==null){
echo "<p>没有查询到你要查找的数据</p>";
}else{
for(\$x=0;\$x< \\3;\$x++){ 
if(getValueByKey(\$randlist_data,\$x,'id')=='')break;
\$view = U('\\2','view','id',getValueByKey(\$randlist_data,\$x,'id'));
\$detail = U('\\2','detail','id',getValueByKey(\$randlist_data,\$x,'id'));
\$name = getValueByKey(\$randlist_data,\$x,'name');
\$pic = getValueByKey(\$randlist_data,\$x,'pic');
\$hit = rand(5, 10000);
\$time = getValueByKey(\$randlist_data,\$x,'time');
?>
tag;

$this->replaces[] = <<<tag
<?php 
foreach(\$data as \$key => \$val) { 
if(\$key==\\2)break;
\$view= U('live','view',base64_encode(\$type_id.'|'.\$val['name']),base64_encode(\$val['m3u8']));
\$name=\$val['name'];
\$pic=\$val['pic'];
\$hit = rand(5, 10000);
\$time = date('Y-m-d');
?>
tag;

$this->replaces[] = '<?php echo \$view;?>';
$this->replaces[] = '<?php echo \$detail;?>';
$this->replaces[] = '<?php echo \$name;?>';
$this->replaces[] = '<?php echo \$pic;?>';
$this->replaces[] = '<?php echo \$hit;?>';
$this->replaces[] = '<?php echo \$time;?>';
$this->replaces[] = '<?php }}?>';
$this->replaces[] = '<?php }?>';
?>