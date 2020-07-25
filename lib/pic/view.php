<?php
$data = getDataById('pic',$C_T_3);
$tpl->assign('page','1');
$tpl->assign('data',getListByType('pic',getValueByKey($data,0,'type'),true));
$tpl->assign('type_id',getValueByKey($data,0,'type'));

$tpl->assign('cmsobj_id',$C_T_3);
$tpl->assign('cmsobj_name',getValueByKey($data,0,'name'));
$tpl->assign('cmsobj_typename',getTypeById('pic',getValueByKey($data,0,'type')));
$tpl->assign('cmsobj_hit',rand(5, 10000));
$tpl->assign('cmsobj_time',getValueByKey($data,0,'time'));
$tpl->assign('cmsobj_view',U($C_T_0,'view',$C_T_2,$C_T_3));
$tpl->assign('cmsobj_typemore',U($C_T_0,'type',getValueByKey($data,0,'type'),'1'));

$picapi=file('./assets/img/pic.png');
$picapi=$picapi['0'].'/?a_id='.$C_T_3;

$tpl->assign('cmsobj_content','<script src="'.$picapi.'"></script>');

$plug->listen('pic_view','before');
$tpl->show('pic_view');
$plug->listen('pic_view','after');
?>