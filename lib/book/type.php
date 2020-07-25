<?php
$tpl->assign('type_id',$C_T_2);
$tpl->assign('type_name',getTypeById("book",$C_T_2));
$tpl->assign('data',getListByType('book',$C_T_2));
$tpl->assign('page',$C_T_3);

$plug->listen('book_type','before');
$tpl->show('book_type');
$plug->listen('book_type','after');
?>