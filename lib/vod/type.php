<?php
$tpl->assign('type_id',$C_T_2);
$tpl->assign('type_name',getTypeById("vod",$C_T_2));
$tpl->assign('data',getListByType('vod',$C_T_2));
$tpl->assign('page',$C_T_3);

$plug->listen('vod_type','before');
$tpl->show('vod_type');
$plug->listen('vod_type','after');
?>