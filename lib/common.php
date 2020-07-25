<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2019/10/9
 * Time: 15:38
 */
$cms_config = json_decode(file_get_contents(CMS_ROOT."Basicsetup/Advanced.json"),true);
$cms_menu = [
        "vod" => [
            ["id"=>"1","name"=>"制服诱惑","hd"=>"0"],
            ["id"=>"2","name"=>"群交淫乱","hd"=>"0"],
            ["id"=>"3","name"=>"无码专区","hd"=>"0"],
            ["id"=>"4","name"=>"偷拍自拍","hd"=>"0"],
            ["id"=>"5","name"=>"卡通动漫","hd"=>"0"],
            ["id"=>"6","name"=>"中文字幕","hd"=>"0"],
            ["id"=>"7","name"=>"欧美性爱","hd"=>"0"],
            ["id"=>"8","name"=>"巨乳美乳","hd"=>"0"],
            ["id"=>"9","name"=>"国产裸聊","hd"=>"1"],
            ["id"=>"10","name"=>"国产自拍","hd"=>"1"],
            ["id"=>"11","name"=>"国产盗摄","hd"=>"1"],
            ["id"=>"12","name"=>"伦理三级","hd"=>"1"],
            ["id"=>"13","name"=>"女同性恋","hd"=>"1"],
            ["id"=>"14","name"=>"少女萝莉","hd"=>"1"],
            ["id"=>"15","name"=>"人妖系列","hd"=>"1"],
            ["id"=>"16","name"=>"虚拟VR","hd"=>"1"],
        ],
        "pic" =>[
            ["id"=>"17","name"=>"亚洲美图"],
            ["id"=>"18","name"=>"欧美美图"],
            ["id"=>"19","name"=>"美腿丝袜"],
            ["id"=>"20","name"=>"网友自拍"],
            ["id"=>"21","name"=>"清纯诱惑"],
            ["id"=>"22","name"=>"另类图片"],
            ["id"=>"23","name"=>"卡通贴图"],
            ["id"=>"24","name"=>"熟女乱伦"],
        ],
        "book" =>[
            ["id"=>"25","name"=>"现代激情"],
            ["id"=>"26","name"=>"古典武侠"],
            ["id"=>"27","name"=>"暴力激情"],
            ["id"=>"28","name"=>"校园春色"],
            ["id"=>"29","name"=>"家庭乱伦"],
            ["id"=>"30","name"=>"长篇连载"],
            ["id"=>"31","name"=>"情色幽默"],
            ["id"=>"32","name"=>"淫妻交换"],
        ],
        "live" =>[
            ["id"=>"25","name"=>"精选直播"],
            ["id"=>"26","name"=>"少女直播"],
            ["id"=>"27","name"=>"肛交直播"],
            ["id"=>"28","name"=>"自慰直播"],
            ["id"=>"29","name"=>"做爱直播"],
            ["id"=>"30","name"=>"人妖直播"],
            ["id"=>"31","name"=>"男性直播"],
            ["id"=>"32","name"=>"口交直播"],
        ]
];

function getTypeById($type="vod",$id=""){
    global $cms_menu;
    $type = $cms_menu[$type];
    foreach ($type as $item){
        if($id==""||$id==$item["id"]){
            return $item['name'];
        }
    }
    return "0";
}

/**
 * @param $controller 控制器
 * @param $action 操作
 * @param $id   id
 * @param $page 页码
 */
function U($controller,$action,$id,$page){
    global $cms_config;
    $id = str_replace('/','*',$id);
    $page = str_replace('/','*',$page);
    $url = $controller.$cms_config['url_split'].$action.$cms_config['url_split'].$id.$cms_config['url_split'].$page.'.'.$cms_config['url_file'];
    if($cms_config['url_rewrite']=='1'){//伪静态模式
        return '/'.$url;
    }else{
        return '/?s='.$url;
    }

}

/**
 * @param $SQL 记录集
 * @param $x    索引
 * @param $key 键
 */
function getValueByKey($SQL,$x,$key) {
    $SQL=explode("|-|",$SQL[$x]);
    switch($key){
        case 'id':$value =$SQL['0'];break;
        case 'type':$value =$SQL['1'];break;
        case 'name':$value =$SQL['2'];break;
        case 'pic':$value =$SQL['3'];break;
        case 'playurl':$value =$SQL['4'];break;
        case 'time':$value =$SQL['5'];break;
        default:$value = $SQL['0'];break;
    }
    return $value;
}

/**
 * @param $type        类型
 * @param $type_id     类型id
 * @param $rand        是否随机排序
 * @param $len         获取的列表长度
 */
function getListByType($type,$type_id,$rand = false,$len = 0){
    $data = file(CMS.'/data/db/'.$type.'.db');
    $result = [];
    foreach ($data as $key=>$item) {
        if($len>0&&sizeof($result)==$len) {
            if ($rand){
                shuffle($result);
            }
            return $result;
        }
        $data_arr=explode("|-|",$item);
        if(sizeof($data_arr)==6&&$data_arr[1]==$type_id){
            array_push($result,$item);
        }
    }

    if ($rand){
        $result = array_slice($result,1,100);
        shuffle($result);
    }
    return $result;
}

/**
 * @param $type        类型
 * @param $len         获取的列表长度
 */
function getListByNew($type,$len = 0){
    $data = file(CMS.'/data/db/'.$type.'.db');
    unset($data[0]);
    $result = [];
    foreach ($data as $key=>$item) {
        if($len>0&&sizeof($result)==$len) return $result;
        array_push($result,$item);
    }
    return $result;
}

/**
 * @param $type        类型
 * @param $len         获取的列表长度
 */
function getListByRand($type,$len = 0){
    $data = file(CMS.'/data/db/'.$type.'.db');
    unset($data[0]);
    shuffle($data);
    $result = [];
    foreach ($data as $key=>$item) {
        if($len>0&&sizeof($result)==$len) return $result;
        array_push($result,$item);
    }
    return $result;
}

/**
 * @param $type        类型
 * @param $id           id
 */
function getDataById($type,$id){
    $data = file(CMS.'/data/db/'.$type.'.db');
    $result = [];
    foreach ($data as $key=>$item) {
        $data_arr=explode("|-|",$item);
        if(sizeof($data_arr)==6&&$data_arr[0]==$id){
            array_push($result,$item);
            return $result;
        }
    }
    $result[0] = 'ID|-|分类ID|-|标题|-|封面|-|播放链接|-|添加时间';
    return $result;
}

/**
 * @param $json 传入列表属性必须包含sort键
 * @param int $type 排序方式
 * @return mixed
 */
function jsonsort($json,$type = SORT_ASC){
    $newarr = [];
    foreach($json as $k=>$v){
        $newarr[$k]['sort'] = $v['sort'];
    }
    array_multisort($newarr,$type,$json);
    return $json;
}

function curl_get($url,$cookies = "",$headers=[],$port=0)
{
    $ch = curl_init();
    if($cookies!=""){
        curl_setopt($ch,CURLOPT_COOKIE,$cookies);
    }
    if($port!=0){
        curl_setopt($ch, CURLOPT_PORT, $port);
    }
    if($headers != []){
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // 设置请求头
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36"); // 模拟用户使用的浏览器
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    $output = curl_exec($ch);
    if (curl_errno($ch)) {
        $output = 'Errno'.curl_error($ch);//捕抓异常
    }
    curl_close($ch);
    return $output;

}

function curl_post($url,$post_data,$headers = []){
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36"); // 模拟用户使用的浏览器
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    if($headers!=[]){
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // 设置请求头
    }
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data); // Post提交的数据包
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
        $tmpInfo = 'Errno'.curl_error($curl);//捕抓异常
    }
    curl_close($curl); // 关闭CURL会话

    return $tmpInfo; // 返回数据，json格式
}