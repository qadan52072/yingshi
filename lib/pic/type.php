<?php
$tpl->assign('type_id',$C_T_2);
$tpl->assign('type_name',getTypeById("pic",$C_T_2));
$tpl->assign('data',getListByType('pic',$C_T_2));
$tpl->assign('page',$C_T_3);

$plug->listen('pic_type','before');
$tpl->show('pic_type');
$plug->listen('pic_type','after');
?>