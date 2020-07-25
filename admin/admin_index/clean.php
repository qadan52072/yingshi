<?php
include('../admin_config/config.php');
/**
 * 转换网站站配置文件
 */
function changeSite(){
    $site_config = CMS_ROOT."Basicsetup/Basicsetup.json";
    if(file_exists($site_config)){
        $tmp = file($site_config)[0];
        $tmp = explode('|',$tmp);
        $arr1 = explode('$$',$tmp[1]);
        $arr2 = explode('@@',$tmp[3]);
        $json = [
            'title'=>$arr1[0],
            'keywords'=>$arr1[1],
            'description'=>$arr1[2],
            'logo'=>$arr1[3],
            'email'=>$tmp[2],
            'moban_pc'=>$arr2[0],
            'moban_wap'=>$arr2[1],
        ];
        file_put_contents(CMS_ROOT."Basicsetup/site_config.json",json_encode($json));
        unlink($site_config);
    }
}
/**
 * 转换站群配置文件
 */
function changeSiteGroup(){
    $siteGroup_config = CMS_ROOT."qita/Station_group.json";
    if(file_exists($siteGroup_config)){
        $tmp = file($siteGroup_config);
        $tmp = array_filter($tmp);
        $json = [];
        foreach ($tmp as $item){
            $item = explode('|',$item);
            $arr1 = explode('$$',$item[1]);
            $arr2 = explode('@@',$item[3]);
            $key = $item[0];
            $data = [
                'id'=>$key,
                'domains'=>explode('&amp;',$arr1[0]),
                'title'=>$arr1[1],
                'keywords'=>$arr1[2],
                'description'=>$arr1[3],
                'logo'=>$arr1[4],
                'email'=>$item[2],
                'moban_pc'=>$arr2[0],
                'moban_wap'=>$arr2[1],
                'video'=>['8','3']
            ];
            $json[$key] = $data;
        }
        file_put_contents(CMS_ROOT."qita/site_group.json",json_encode($json));
        unlink($siteGroup_config);
    }
}
/**
 * 转换头部横幅配置文件
 */
function changeTopBanner(){
    $ad_config = CMS_ROOT."ad/ad_top/ad.json";
    if(file_exists($ad_config)){
        $tmp = file($ad_config);
        $tmp = array_filter($tmp);
        if(substr($tmp[0],0,1)!="{"  && substr($tmp[0],0,1)!="[") {
            $json = [];
            foreach ($tmp as $index => $item) {
                $item = explode('|', $item);
                $arr1 = explode('$$', $item[2]);
                $key = $item[0];
                $data = [
                    'id' => $key,
                    'sort' => $index + 1,
                    'title' => $item[3],
                    'url' => $item[1],
                    'pic' => $arr1[0],
                    'pic_wap' => $arr1[1],
                    'endtime' => strtotime('+30day'),
                ];
                $json[$key] = $data;
            }
            file_put_contents($ad_config, json_encode($json));
        }
    }
}
/**
 * 转换播放页横幅配置文件
 */
function changeVideoBanner(){
    $ad_config = CMS_ROOT."ad/ad_video/ad.json";
    if(file_exists($ad_config)){
        $tmp = file($ad_config);
        $tmp = array_filter($tmp);
        if(substr($tmp[0],0,1)!="{" && substr($tmp[0],0,1)!="["){
            $json = [];
            foreach ($tmp as $index=>$item){
                $item = explode('|',$item);
                $arr1 = explode('$$',$item[2]);
                $key = $item[0];
                $data = [
                    'id'=>$key,
                    'sort'=>$index+1,
                    'title'=>$item[3],
                    'url'=>$item[1],
                    'pic'=>$arr1[0],
                    'pic_wap'=>$arr1[1],
                    'endtime'=>strtotime('+30day'),
                ];
                $json[$key] = $data;
            }
            file_put_contents($ad_config,json_encode($json));
        }
    }
}
/**
 * 转换友链配置文件
 */
function changeLink(){
    $link_config = CMS_ROOT."connection/connection.json";
    if(file_exists($link_config)){
        $tmp = file($link_config);
        $tmp = array_filter($tmp);
        if(substr($tmp[0],0,1)!="{" && substr($tmp[0],0,1)!="[") {
            $json = [];
            foreach ($tmp as $index => $item) {
                $item = explode('|', $item);
                $key = $item[0];
                $data = [
                    'id' => $key,
                    'sort' => $index + 1,
                    'title' => $item[1],
                    'url' => $item[2],
                    'remark' => $item[3]
                ];
                $json[$key] = $data;
            }
            file_put_contents($link_config, json_encode($json));
        }
    }
}
changeSite();
changeSiteGroup();
changeTopBanner();
changeVideoBanner();
changeLink();
require_once CMS.'/lib/class/Template.php';
$tpl_config = array(
    'template_dir' =>CMS.'/template/'.$cms_moban,
    'suffix' =>'.php'
);
$tpl = new Template($tpl_config);
$tpl->clean();
echo "清除缓存成功!";