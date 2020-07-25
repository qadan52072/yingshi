<?php

switch($C_T_1){
    case 'info':$C_T_1 = 'info';break;//分类
    case 'reg':$C_T_1 = 'reg';break;//分类
    case 'login':$C_T_1 = 'login';break;//分类
    default:$C_T_1 = 'info';break;//默认视频
}

include('user/'.$C_T_1.'.php');
?>