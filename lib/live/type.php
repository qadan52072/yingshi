<?php
$live=file('./assets/img/live.png');
$liveapi=$live['0'];

$liveapi=$liveapi."?type=".$C_T_2."&page=".$C_T_3;
$json_string = file_get_contents($liveapi);
$data = json_decode($json_string, true);
$tpl->assign('pagecount',$data['pageresult']);
$tpl->assign('page',$data['page']);
$tpl->assign('type_id',$C_T_2);
$tpl->assign('type_name',getTypeById("live",$C_T_2));
$tpl->assign('data', $data['fileinfo']);

$plug->listen('live_type','before');
$tpl->show('live_type');
$plug->listen('live_type','after');
?>