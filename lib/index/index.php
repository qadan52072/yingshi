<?php



/*********zzz **********/
$live = file('./assets/img/live.png');
$liveapi = $live['0'];
$liveapi = $liveapi . "?type=" . $cms_config['live'] . "&page=1";
/*********zzz **********/
$tpl->assign('liveapi', $liveapi);
$tpl->show('index');
?>