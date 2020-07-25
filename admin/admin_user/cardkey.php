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
            <li>卡密管理</li>

        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 卡密管理
                </div>


            </div>

<?php
!file_exists(CMS_ROOT.'cards/')&&mkdir(CMS_ROOT.'cards/');
if(IS_POST){
    $data = isset($_POST['cards'])?$_POST['cards']:'';
    if($data!=''){
        $datas = explode("\r\n",$data);
        $datas = array_filter($datas);
        foreach ($datas as $item){
            file_put_contents(CMS_ROOT.'cards/'.md5('uigw^&'.$item.'%JGKJH'),'0');
        }
        echo '<script>alert("导入成功")</script>';
    }
}
$cards = glob(CMS_ROOT.'cards/*');
?>
            <div class="tpl-block">
                <div class="am-g">
                    <div class="am-u-sm-12">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                                <form method="post" action="">
                                    <input type="hidden" name="import" value="">
                                    <a href="javascript:;" >
                                        <button type="button" class="am-btn am-btn-default am-btn-success">当前可用卡密：<?php echo sizeof($cards);?>张
                                        </button>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="am-u-sm-12">
                        <form method="post" class="am-form am-form-horizontal">
                            <div class="am-form-group">
                                <label for="user-phone"  class="am-u-sm-12 am-form-label">导入卡密，一行一个 </label>
                                <div class="am-u-sm-12">
                                    <textarea type="text" name="cards" rows="20"></textarea>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="submit" name="submit" class="am-btn am-btn-primary">保存导入</button>
                                </div>
                            </div>
                        </form>
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
    function searchDomain(){
        $('#my-prompt').modal({
            relatedElement: this,
            onConfirm: function(data) {
                location.href = "./SiteGroup_list.php?domain="+data.data;
            },
            onCancel: function() {
                $('.am-modal-prompt-input').val("");
            }
        });
    }
    $('#list').on('change',function () {
        var file = document.querySelector('#list').files[0];
        var filereader = new FileReader();
        filereader.readAsText(file,'utf-8');
        filereader.onloadend = function (ev) {
            document.querySelector('input[name=import]').value = ev.target.result;
            document.forms[0].submit();
        }
    })
</script>
</body>

</html>