<?php
$data = getDataById('vod',$C_T_3);
$tpl->assign('page','1');
$tpl->assign('data',getListByType('vod',getValueByKey($data,0,'type'),true));
$tpl->assign('type_id',getValueByKey($data,0,'type'));

$tpl->assign('cmsobj_id',$C_T_3);
$tpl->assign('cmsobj_name',getValueByKey($data,0,'name'));
$tpl->assign('cmsobj_typename',getTypeById('vod',getValueByKey($data,0,'type')));
$tpl->assign('cmsobj_hit',rand(5, 10000));
$tpl->assign('cmsobj_time',getValueByKey($data,0,'time'));
$tpl->assign('cmsobj_view',U($C_T_0,'view',$C_T_2,$C_T_3));
$tpl->assign('cmsobj_typemore',U($C_T_0,'type',getValueByKey($data,0,'type'),'1'));

$tpl->assign('cmsobj_pic',getValueByKey($data,0,'pic'));
$url = getValueByKey($data,0,'playurl');
$tpl->assign('cmsobj_url',$url);
$player = <<<tag
<video id='myVideo'   class="video-js"></video>
<link rel="stylesheet" type="text/css" href="/static/VideoJS/video.min.css?v=3">
<script type="text/javascript" src="/static/VideoJS/video.min.js?v=1" charset="utf-8" > </script>
<script type="text/javascript" src="/static/VideoJS/video-conrtib-sina.js?v=1" charset="utf-8" > </script>
<script type="text/javascript" src="/static/VideoJS/myVideo.js?v=6" charset="utf-8" > </script>
<script type="text/javascript">
	var myVideo=initVideo({
		id:'myVideo',
		url:'$url',
		logo:{
			url:'{$cms_system['cms_logo']}',
			width:'100px'
		},
	});
</script>
tag;

$tpl->assign('cmsobj_content',$player);

$plug->listen('vod_detail','before');
$tpl->show('detail');
$plug->listen('vod_detail','after');
?>