<?php

if($C_T_2 =='so'&&isset($_GET['TXT'])){
	function post_input($data){$data = stripslashes($data);$data = htmlspecialchars($data);return $data;}
	$txt = trim(post_input($_GET['TXT']));
	if($txt!=''){
        header('location:'.U('search','type',$txt,'1'));
    }else{
        header('/');
    }
	return;
}

$data=file('./data/db/vod.db');
$count=count($data)-1;
$data_chuli="";
for ($x=1; $x<=$count; $x++) {
	$data_arr=explode("|-|",$data[$x]); 	$datas=$data_arr['2'];
	if(preg_match ("/{$C_T_2}/" , $datas )){ $data_chuli .=$data_arr['0']."|-|".$data_arr['1']."|-|".$data_arr['2']."|-|".$data_arr['3']."|-|".$data_arr['4']."|-|".$data_arr['5'];$data_chuli .="\n";	 }

}

$tpl->assign('page',$C_T_3);
$tpl->assign('type_name',$C_T_2);
$tpl->assign('data',array_values(array_filter( explode("\n", $data_chuli))));

$plug->listen('search_type','before');
$tpl->show('search_type');
$plug->listen('search_type','after');
?>