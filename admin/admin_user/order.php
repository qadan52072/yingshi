<?php include('../admin_config/config.php'); ?>
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
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="<?php echo CMS_ADMIN_url; ?>assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo CMS_ADMIN_url; ?>assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <link rel="stylesheet" href="<?php echo CMS_ADMIN_url; ?>assets/css/amazeui.min.css"/>
    <link rel="stylesheet" href="<?php echo CMS_ADMIN_url; ?>assets/css/admin.css">
    <link rel="stylesheet" href="<?php echo CMS_ADMIN_url; ?>assets/css/app.css">
    <script src="<?php echo CMS_ADMIN_url; ?>assets/js/echarts.min.js"></script>
</head>

<body data-type="index">
<?php include('../admin_config/admin_top.php');; ?>
<div class="tpl-page-container tpl-page-header-fixed">
    <?php include('../admin_config/admin_list.php');; ?>
    <div class="tpl-content-wrapper">

        <ol class="am-breadcrumb">
            <li><a href="javascript:;" class="am-icon-home">首页</a></li>
            <li>用户设置</li>
            <li>充值订单</li>

        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 充值订单
                </div>


            </div>


            <div class="tpl-block">
                <div class="am-g">
                    <div class="am-u-sm-12 am-u-md-6">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                                <form method="post" action="">
                                    <input type="hidden" name="import" value="">
                                    <a href="./order.php">
                                        <button type="button" class="am-btn am-btn-default am-btn-success">全部
                                        </button>
                                    </a>
                                    <a href="./order.php?create=today">
                                        <button type="button" class="am-btn am-btn-default am-btn-success">今天
                                        </button>
                                    </a>
                                    <a href="./order.php?create=yesterday" >
                                        <button type="button" class="am-btn am-btn-default am-btn-success">昨天
                                        </button>
                                    </a>
                                    <a href="./order.php?create=oneweek" >
                                        <button type="button" class="am-btn am-btn-default am-btn-success">本周
                                        </button>
                                    </a>
                                    <a href="./order.php?create=onemonth" >
                                        <button type="button" class="am-btn am-btn-default am-btn-success">本月
                                        </button>
                                    </a>
                                    <a href="javascript:;" onclick="searchUser()">
                                        <button type="button" class="am-btn am-btn-default am-btn-success">搜索
                                        </button>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="am-u-sm-12">
                        <form class="am-form">
                            <table class="am-table am-table-striped am-table-hover table-main">
                                <thead>
                                <tr>
                                    <th class="table-title">订单号</th>
                                    <th class="table-title">卡密</th>
                                    <th class="table-date">充值账号</th>
                                    <th class="table-date am-hide-sm-only">充值时间</th>
                                </tr>
                                </thead>
                                <tbody style="word-break: break-all;">
                                <?php

                                error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
                                header("Content-type: text/html; charset=utf-8");
                                $orders = glob(CMS_ROOT.'orders/*');
                                $json = [];
                                if(isset($_GET['email'])){
                                    foreach($orders as $order){
                                        $tmp = explode('-',basename($order));
                                        if(file_get_contents($order)==$_GET['email']){
                                            $obj['orderno'] = basename($order);
                                            $obj['cardkey'] = $tmp[0];
                                            $obj['usermail'] = file_get_contents($order);
                                            $obj['time'] = date('Y-m-d H:i:s',$tmp[1]);
                                            array_push($json,$obj);
                                        }
                                    }
                                }elseif(isset($_GET['create'])){
                                    switch ($_GET['create']){
                                        case 'today':
                                            foreach($orders as $order){
                                                $tmp = explode('-',basename($order));
                                                if($tmp[1]>strtotime(date('Y-m-d 0:0:0'))){
                                                    $obj['orderno'] = basename($order);
                                                    $obj['cardkey'] = $tmp[0];
                                                    $obj['usermail'] = file_get_contents($order);
                                                    $obj['time'] = date('Y-m-d H:i:s',$tmp[1]);
                                                    array_push($json,$obj);
                                                }
                                            }
                                            break;
                                        case 'yesterday':
                                            foreach($orders as $order){
                                                $tmp = explode('-',basename($order));
                                                if($tmp[1]>strtotime(date('Y-m-d 0:0:0',strtotime('-1 day')))&&$tmp[1]<strtotime(date('Y-m-d 0:0:0'))){
                                                    $obj['orderno'] = basename($order);
                                                    $obj['cardkey'] = $tmp[0];
                                                    $obj['usermail'] = file_get_contents($order);
                                                    $obj['time'] = date('Y-m-d H:i:s',$tmp[1]);
                                                    array_push($json,$obj);
                                                }
                                            }
                                            break;
                                        case 'oneweek':
                                            foreach($orders as $order){
                                                $tmp = explode('-',basename($order));
                                                if($tmp[1]>strtotime(date('Y-m-d 0:0:0', (time() - ((date('w') == 0 ? 7 : date('w')) - 1) * 24 * 3600)))){
                                                    $obj['orderno'] = basename($order);
                                                    $obj['cardkey'] = $tmp[0];
                                                    $obj['usermail'] = file_get_contents($order);
                                                    $obj['time'] = date('Y-m-d H:i:s',$tmp[1]);
                                                    array_push($json,$obj);
                                                }
                                            }
                                            break;
                                        case 'onemonth':
                                            foreach($orders as $order){
                                                $tmp = explode('-',basename($order));
                                                if($tmp[1]>strtotime(date('Y-m-1 0:0:0'))){
                                                    $obj['orderno'] = basename($order);
                                                    $obj['cardkey'] = $tmp[0];
                                                    $obj['usermail'] = file_get_contents($order);
                                                    $obj['time'] = date('Y-m-d H:i:s',$tmp[1]);
                                                    array_push($json,$obj);
                                                }
                                            }
                                            break;
                                    }
                                }else{
                                    foreach($orders as $order){
                                        $tmp = explode('-',basename($order));

                                        $obj['orderno'] = basename($order);
                                        $obj['cardkey'] = $tmp[0];
                                        $obj['usermail'] = file_get_contents($order);
                                        $obj['time'] = date('Y-m-d H:i:s',$tmp[1]);
                                        array_push($json,$obj);
                                    }
                                }

                                foreach ($json as $key => $item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $item['orderno'];?></td>
                                        <td><?php echo $item['cardkey']; ?></td>
                                        <td class="table-date am-hide-sm-only"><?php echo $item['usermail']; ?></td>
                                        <td class="table-date am-hide-sm-only"><?php echo $item['time']; ?></td>
                                    </tr>

                                    <?php
                                }
                                ?>

                                </tbody>
                            </table>
                            <hr>

                        </form>
                    </div>

                </div>


                <!--弹窗-->
                <div class="am-modal am-modal-prompt" tabindex="-1" id="my-prompt">
                    <div class="am-modal-dialog">
                        <div class="am-modal-hd">输入您要查找的用户邮箱</div>
                        <div class="am-modal-bd">
                            <input type="text" class="am-modal-prompt-input">
                        </div>
                        <div class="am-modal-footer">
                            <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                            <span class="am-modal-btn" data-am-modal-confirm>提交</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tpl-alert"></div>
        </div>
    </div>
    <?php include('../admin_config/admin_foot.php'); ?>
</div>

<script src="<?php echo CMS_ADMIN_url; ?>assets/js/jquery.min.js"></script>
<script src="<?php echo CMS_ADMIN_url; ?>assets/js/amazeui.min.js"></script>
<script src="<?php echo CMS_ADMIN_url; ?>assets/js/iscroll.js"></script>
<script src="<?php echo CMS_ADMIN_url; ?>assets/js/app.js"></script>
<script>
    function searchUser(){
        $('#my-prompt').modal({
            relatedElement: this,
            onConfirm: function(data) {
                location.href = "./order.php?email="+data.data;
            },
            onCancel: function() {
                $('.am-modal-prompt-input').val("");
            }
        });
    }
</script>
</body>

</html>