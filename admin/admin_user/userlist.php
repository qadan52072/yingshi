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
            <li>用户列表</li>

        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 用户列表
                </div>


            </div>


            <div class="tpl-block">
                <div class="am-g">
                    <div class="am-u-sm-12 am-u-md-6">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                                <form method="post" action="">
                                    <input type="hidden" name="import" value="">
                                    <a href="./userlist.php">
                                        <button type="button" class="am-btn am-btn-default am-btn-success">全部
                                        </button>
                                    </a>
                                    <a href="./userlist.php?create=today">
                                        <button type="button" class="am-btn am-btn-default am-btn-success">今天
                                        </button>
                                    </a>
                                    <a href="./userlist.php?create=yesterday" >
                                        <button type="button" class="am-btn am-btn-default am-btn-success">昨天
                                        </button>
                                    </a>
                                    <a href="./userlist.php?create=oneweek" >
                                        <button type="button" class="am-btn am-btn-default am-btn-success">本周
                                        </button>
                                    </a>
                                    <a href="./userlist.php?create=onemonth" >
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
                                    <th class="table-title">用户名</th>
                                    <th class="table-title">注册时间</th>
                                    <th class="table-title">会员状态</th>
                                    <th class="table-set">操作</th>
                                </tr>
                                </thead>
                                <tbody style="word-break: break-all;">
                                <?php
                                error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
                                header("Content-type: text/html; charset=utf-8");
                                $userlist = glob(CMS_ROOT.'users/*');
                                $json = [];
                                if (isset($_GET['vip'])){
                                    $userpath = CMS_ROOT.'users/'.$_GET['vip'].'.txt';
                                    $old = json_decode(file_get_contents($userpath),true);
                                    $old['vip'] = $old['vip']>time()?$old['vip']+(86400*$_GET['day']):time()+(86400*$_GET['day']);
                                    file_put_contents($userpath,json_encode($old));
                                    echo '<script>alert("操作成功！");location.href="./userlist.php"</script>';
                                }
                                if (isset($_GET['reset'])){
                                    $userpath = CMS_ROOT.'users/'.$_GET['reset'].'.txt';
                                    $old = json_decode(file_get_contents($userpath),true);
                                    $old['key'] = md5('sdi%^&123456hfjs');
                                    file_put_contents($userpath,json_encode($old));
                                    echo '<script>alert("密码重置成功！");location.href="./userlist.php"</script>';
                                }
                                if(isset($_GET['email'])){
                                    if(file_exists(CMS_ROOT.'users/'.$_GET['email'].'.txt')){
                                        $json[$_GET['email']] = json_decode(file_get_contents(CMS_ROOT.'users/'.$_GET['email'].'.txt'),true);
                                    }
                                }elseif(isset($_GET['create'])){
                                    switch ($_GET['create']){
                                        case 'today':
                                            foreach($userlist as $user){
                                                $tmp = json_decode(file_get_contents($user),true);
                                                if($tmp['create']>strtotime(date('Y-m-d 0:0:0'))){
                                                    $json[substr(basename($user),0,-4)] = $tmp;
                                                }
                                            }
                                            break;
                                        case 'yesterday':
                                            foreach($userlist as $user){
                                                $tmp = json_decode(file_get_contents($user),true);
                                                if($tmp['create']>strtotime(date('Y-m-d 0:0:0',strtotime('-1 day')))&&$tmp['create']<strtotime(date('Y-m-d 0:0:0'))){
                                                    $json[substr(basename($user),0,-4)] = $tmp;
                                                }
                                            }
                                            break;
                                        case 'oneweek':
                                            foreach($userlist as $user){
                                                $tmp = json_decode(file_get_contents($user),true);
                                                if($tmp['create']>strtotime(date('Y-m-d 0:0:0', (time() - ((date('w') == 0 ? 7 : date('w')) - 1) * 24 * 3600)))){
                                                    $json[substr(basename($user),0,-4)] = $tmp;
                                                }
                                            }
                                            break;
                                        case 'onemonth':
                                            foreach($userlist as $user){
                                                $tmp = json_decode(file_get_contents($user),true);
                                                if($tmp['create']>strtotime(date('Y-m-1 0:0:0'))){
                                                    $json[substr(basename($user),0,-4)] = $tmp;
                                                }
                                            }
                                            break;
                                    }
                                }else{
                                    foreach($userlist as $user){
                                        $json[substr(basename($user),0,-4)] = json_decode(file_get_contents($user),true);
                                    }
                                }


                                foreach ($json as $key => $item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $key ?></td>
                                        <td><?php echo date('Y-m-d H:i:s',$item['create']); ?></td>
                                        <td><?php echo $item['vip']>time()?date('Y-m-d H:i:s',$item['vip']):'非会员'; ?></td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <a href="javascript:;"
                                                       onclick="vip('<?php echo $key; ?>')"
                                                       class="am-btn am-btn-default am-btn-xs am-text-secondary"><span
                                                            class="am-icon-paypal"></span> 充值会员</a>
                                                    <a href="?reset=<?php echo $key; ?>"
                                                       onclick="return confirm('确定要将该用户密码重置为123456吗？')"
                                                       class="am-btn am-btn-default am-btn-xs am-text-danger _am-hide-sm-only"><span
                                                            class="am-icon-refresh"></span> 重置密码</a>
                                                </div>
                                            </div>
                                        </td>
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

                <!--开会员弹窗-->
                <div class="am-modal am-modal-prompt" tabindex="-1" id="vip-prompt">
                    <div class="am-modal-dialog">
                        <div class="am-modal-hd">输入您要充值的时长（单位为天）</div>
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
                location.href = "./userlist.php?email="+data.data;
            },
            onCancel: function() {
                $('.am-modal-prompt-input').val("");
            }
        });
    }
    function vip(mail) {
        $('#vip-prompt').modal({
            relatedElement: this,
            onConfirm: function(data) {
                location.href = "./userlist.php?vip="+mail+"&day="+data.data;
            },
            onCancel: function() {
                $('.am-modal-prompt-input').val("");
            }
        });
    }
</script>
</body>

</html>