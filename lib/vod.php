<?php

switch($C_T_1){
	case 'type':$C_T_1 = 'type';break;//分类
	case 'detail':$C_T_1 = 'detail';break;//详情页
	case 'view':$C_T_1 = 'view';break;//内容
	default:$C_T_1 = 'type';break;//默认视频	
	}
include('vod/'.$C_T_1.'.php');
?>