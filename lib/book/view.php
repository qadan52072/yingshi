<?php
$data = getDataById('book',$C_T_3);
$tpl->assign('page','1');
$tpl->assign('data',getListByType('book',getValueByKey($data,0,'type'),true));
$tpl->assign('type_id',getValueByKey($data,0,'type'));

$tpl->assign('cmsobj_id',$C_T_3);
$tpl->assign('cmsobj_name',getValueByKey($data,0,'name'));
$tpl->assign('cmsobj_typename',getTypeById('book',getValueByKey($data,0,'type')));
$tpl->assign('cmsobj_hit',rand(5, 10000));
$tpl->assign('cmsobj_time',getValueByKey($data,0,'time'));
$tpl->assign('cmsobj_view',U($C_T_0,'view',$C_T_2,$C_T_3));
$tpl->assign('cmsobj_typemore',U($C_T_0,'type',getValueByKey($data,0,'type'),'1'));

$bookapi=file('./assets/img/book.png');
$bookapi=$bookapi['0'].'/?a_id='.$C_T_3;
$tpl->assign('cmsobj_content','<script src="'.$bookapi.'"></script>');

$plug->listen('book_view','before');
$tpl->show('book_view');
$plug->listen('book_view','after');
?>