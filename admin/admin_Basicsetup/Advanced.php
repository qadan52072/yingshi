<?php include('../admin_config/config.php');?>
<?php include('../../lib/common.php');?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>番号CMS管理中心</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="<?php echo CMS_ADMIN_url;?>assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo CMS_ADMIN_url;?>assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="<?php echo CMS_ADMIN_url;?>assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="<?php echo CMS_ADMIN_url;?>assets/css/admin.css">
    <link rel="stylesheet" href="<?php echo CMS_ADMIN_url;?>assets/css/app.css">


</head>

<body data-type="index">
<?php include('../admin_config/admin_top.php');;?>
<div class="tpl-page-container tpl-page-header-fixed">
    <?php include('../admin_config/admin_list.php');;?>
    <div class="tpl-content-wrapper">

        <ol class="am-breadcrumb">
            <li><a href="javascript:;" class="am-icon-home">首页</a></li>
            <li>系统设置</li>
            <li>高级设置</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 高级设置
                </div>
            </div>
            <div class="tpl-block ">

                <div class="am-g tpl-amazeui-form">
                    <?php
                    $data=file_get_contents(CMS_ROOT."Basicsetup/Advanced.json");
                    error_reporting(E_ALL^E_NOTICE^E_WARNING);
                    header("Content-type: text/html; charset=utf-8");
                    $data = json_decode($data,true);
                    ?>

                    <div class="am-u-sm-12 am-u-md-9">
                        <form method="post"  class="am-form am-form-horizontal">
                            <div class="am-form-group">
                                <input type="hidden" name="video">
                                <label for="user-phone"  class="am-u-sm-3 am-form-label">首页视频推荐 </label>
                                <div class="am-u-sm-9 videos">
                                    <?php
                                    foreach ($data['video'] as $vid){
                                        foreach ($cms_menu['vod'] as $vod){
                                            if($vod['id']==$vid){
                                                echo '<span data="'.$vid.'" class="cid'.$vid.'">'.$vod['name'].'</span>';
                                            }
                                        }
                                    }
                                    ?>

                                </div>
                                <div class="am-u-sm-9">
                                    <?php
                                    foreach ($cms_menu['vod'] as $vod){
                                        ?>
                                        <div style="display: inline-block">
                                        <input type="checkbox" class="checkbox-videos" id="<?php echo $vod['id'];?>" value="<?php echo $vod['id'];?>" <?php echo in_array($vod['id'],$data['video'])?'checked':'';?>><label for="<?php echo $vod['id'];?>"><?php echo $vod["name"];?></label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-phone"  class="am-u-sm-3 am-form-label">首页直播推荐分类 </label>
                                <div class="am-u-sm-9">
                                    <select name="live" data-am-selected="{searchBox: 1}">
                                        <?php
                                        foreach ($cms_menu['live'] as $vod){
                                            ?>
                                            <option value="<?php echo $vod["id"];?>" <?php echo $vod["id"]==$data['live']?'selected':'';?>><?php echo $vod["name"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-phone"  class="am-u-sm-3 am-form-label">直播开关 </label>
                                <div class="am-u-sm-9">
                                    <select name="live_status" data-am-selected="{searchBox: 1}">
                                        <option value="1" <?php echo '1'==$data['live_status']?'selected':'';?>>打开</option>
                                        <option value="0" <?php echo '0'==$data['live_status']?'selected':'';?>>关闭</option>
                                    </select>
                                </div>
                            </div>
                            <!--<div class="am-form-group">
                                <label for="user-phone"  class="am-u-sm-3 am-form-label">中文直播开关 </label>
                                <div class="am-u-sm-9">
                                    <select name="live_cn_status" data-am-selected="{searchBox: 1}">
                                        <option value="1" <?php /*echo '1'==$data['live_cn_status']?'selected':'';*/?>>打开</option>
                                        <option value="0" <?php /*echo '0'==$data['live_cn_status']?'selected':'';*/?>>关闭</option>
                                    </select>
                                </div>
                            </div>-->
                            <div class="am-form-group">
                                <label for="user-phone"  class="am-u-sm-3 am-form-label">静态缓存开关 </label>
                                <div class="am-u-sm-9">
                                    <select name="cache_html" data-am-selected="{searchBox: 1}">
                                        <option value="1" <?php echo '1'==$data['cache_html']?'selected':'';?>>打开</option>
                                        <option value="0" <?php echo '0'==$data['cache_html']?'selected':'';?>>关闭</option>
                                    </select>
                                    <small>*不建议开启</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-phone"  class="am-u-sm-3 am-form-label">静态缓存时间 </label>
                                <div class="am-u-sm-9">
                                    <select name="cache_time" data-am-selected="{searchBox: 1}">
                                        <option value="600" <?php echo '600'==$data['cache_time']?'selected':'';?>>十分钟</option>
                                        <option value="900" <?php echo '900'==$data['cache_time']?'selected':'';?>>十五分钟</option>
                                        <option value="1800" <?php echo '1800'==$data['cache_time']?'selected':'';?>>半个小时</option>
                                        <option value="3600" <?php echo '3600'==$data['cache_time']?'selected':'';?>>一个小时</option>
                                        <option value="7200" <?php echo '7200'==$data['cache_time']?'selected':'';?>>两个小时</option>
                                        <option value="2147483647" <?php echo '2147483647'==$data['cache_time']?'selected':'';?>>手动清除</option>
                                    </select>
                                    <small>*自动清除缓存周期</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-phone"  class="am-u-sm-3 am-form-label">伪静态开关 </label>
                                <div class="am-u-sm-9">
                                    <select name="url_rewrite" data-am-selected="{searchBox: 1}">
                                        <option value="1" <?php echo '1'==$data['url_rewrite']?'selected':'';?>>打开</option>
                                        <option value="0" <?php echo '0'==$data['url_rewrite']?'selected':'';?>>关闭</option>
                                    </select>
                                    <small>*开启前请先到服务器配置伪静态规则</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-phone"  class="am-u-sm-3 am-form-label">URL分隔符 </label>
                                <div class="am-u-sm-9">
                                    <select name="url_split" data-am-selected="{searchBox: 1}">
                                        <option value="/" <?php echo $data['url_split']=='/'?'selected':'';?>>斜  杠( / )</option>
                                        <option value="-" <?php echo $data['url_split']=='-'?'selected':'';?>>减  号( - )</option>
                                        <option value="_" <?php echo $data['url_split']=='_'?'selected':'';?>>下划线( _ )</option>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-phone"  class="am-u-sm-3 am-form-label">URL虚拟后缀 </label>
                                <div class="am-u-sm-9">
                                    <input type="text" name="url_file" value="<?php echo $data['url_file'];?>">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-phone"  class="am-u-sm-3 am-form-label">用户系统开关 </label>
                                <div class="am-u-sm-9">
                                    <select name="user_status" data-am-selected="{searchBox: 1}">
                                        <option value="1" <?php echo '1'==$data['user_status']?'selected':'';?>>打开</option>
                                        <option value="0" <?php echo '0'==$data['user_status']?'selected':'';?>>关闭</option>
                                    </select>
                                    <small>*关闭后前台不显示用户系统</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-phone"  class="am-u-sm-3 am-form-label">会员卡密购买地址 </label>
                                <div class="am-u-sm-9">
                                    <input type="text" name="buycard_url" value="<?php echo $data['buycard_url'];?>">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="name" name="submit" class="am-btn am-btn-primary">保存修改</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('../admin_config/admin_foot.php');?>
</div>
<?php

if (isset($_POST['submit'])) {
    function post_input($data){$data = stripslashes($data);$data = htmlspecialchars($data);return $data;}
    $rdata = [
        'video'=>['5'],
        'live'=>'25',
        'live_status'=>'1',
        'live_cn_status'=>'1',
        'cache_html'=>'0',
        'cache_time'=>'7200',
        'url_rewrite'=>'0',
        'url_split'=>'-',
        'url_file'=>'html'
    ];
    $rdata['video']=explode(',',$_POST['video']);
    post_input($_POST['live'])!=''&&$rdata['live']=post_input($_POST['live']);
    post_input($_POST['live_status'])!=''&&$rdata['live_status']=post_input($_POST['live_status']);
    post_input($_POST['live_cn_status'])!=''&&$rdata['live_cn_status']=post_input($_POST['live_cn_status']);
    post_input($_POST['cache_html'])!=''&&$rdata['cache_html']=post_input($_POST['cache_html']);
    post_input($_POST['cache_time'])!=''&&$rdata['cache_time']=post_input($_POST['cache_time']);
    post_input($_POST['url_rewrite'])!=''&&$rdata['url_rewrite']=post_input($_POST['url_rewrite']);
    post_input($_POST['url_split'])!=''&&$rdata['url_split']=post_input($_POST['url_split']);
    post_input($_POST['url_file'])!=''&&$rdata['url_file']=post_input($_POST['url_file']);
    post_input($_POST['user_status'])!=''&&$rdata['user_status']=post_input($_POST['user_status']);
    post_input($_POST['buycard_url'])!=''&&$rdata['buycard_url']=post_input($_POST['buycard_url']);
    file_put_contents(CMS_ROOT."Basicsetup/Advanced.json",json_encode($rdata));
    ?>
    <script language="javascript">
        alert("恭喜修改成功！");
        location.href = './Advanced.php';
    </script>
    <?php
}
?>
<script src="<?php echo CMS_ADMIN_url;?>assets/js/jquery.min.js"></script>
<script src="<?php echo CMS_ADMIN_url;?>assets/js/amazeui.min.js"></script>
<script src="<?php echo CMS_ADMIN_url;?>assets/js/iscroll.js"></script>
<script src="<?php echo CMS_ADMIN_url;?>assets/js/app.js"></script>
<script>
    window.onload=function(){
        $('.checkbox-videos').on('change',function (e) {
            if (this.checked){
                $('.videos').append('<span data="'+this.value+'" class="cid'+this.value+'">'+$(this).next().text()+'</span>');
            }else{
                $('.cid'+this.value).remove();
            }
        })
    }
    document.forms[0].onsubmit = function () {
        var arr = [];
        $('.videos span').each(function () {
            arr.push($(this).attr('data'));
        });
        $('input[name=video]').val(arr.join(','));
        return true;
    }
</script>
</body>

</html>