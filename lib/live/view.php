<?php
$_live_tmp = explode('|',base64_decode($C_T_2));
$live=file('./assets/img/live.png');
$liveapi=$live['0'];
$liveapi=$liveapi."?type=".$_live_tmp[0]."&page=1";
$json_string = file_get_contents($liveapi);
$data = json_decode($json_string, true);
$live_player=file('./assets/img/player.png');
$live_player=$live_player['0'].'/?smbb='.$C_T_3;
$tpl->assign('page','1');
$tpl->assign('data',$data['fileinfo']);
$tpl->assign('type_id',$_live_tmp[0]);

$tpl->assign('cmsobj_id',$C_T_3);
$tpl->assign('cmsobj_name',$_live_tmp[1]);
$tpl->assign('cmsobj_typename',getTypeById('live',$_live_tmp[0]));
$tpl->assign('cmsobj_hit',rand(5, 10000));
$tpl->assign('cmsobj_time',date('Y-m-d'));
$tpl->assign('cmsobj_view',U($C_T_0,'view',$C_T_2,$C_T_3));
$tpl->assign('cmsobj_typemore',U($C_T_0,'type',$_live_tmp[0],'1'));

$tpl->assign('cmsobj_content','<script src="'.$live_player.'"></script>');

$plug->listen('live_view','before');
$tpl->show('live_view');
$plug->listen('live_view','after');
?>