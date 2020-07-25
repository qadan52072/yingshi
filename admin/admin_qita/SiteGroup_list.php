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
            <li>其他设置</li>
            <li>站群管理</li>

        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 站群管理
                </div>


            </div>


            <div class="tpl-block">
                <div class="am-g">
                    <div class="am-u-sm-12 am-u-md-6">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                                <form method="post" action="">
                                    <input type="hidden" name="import" value="">
                                <a href="SiteGroup_add.php">
                                    <button type="button" class="am-btn am-btn-default am-btn-success"><span
                                                class="am-icon-plus"></span> 添加域名
                                    </button>
                                </a>
                                <a href="javascript:;" onclick="searchDomain()">
                                    <button type="button" class="am-btn am-btn-default am-btn-success"><span
                                                class="am-icon-search"></span> 域名查找
                                    </button>
                                </a>
                                <a href=""><button type="button" class="am-btn am-btn-default am-btn-success" style="position: relative;overflow: hidden"><span class="am-icon-upload"></span> 导入<input type="file" id="list" style="position: absolute;top: 0;left: 0;height: 100%;width: 100%;z-index: 999;opacity: 0" onclick="return confirm('导入将会直接覆盖原数据，是否导入？');"></button></a>
                                    <a href="../../config/qita/site_group.json" download="site_group.json">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span
                                                    class="am-icon-download"></span> 导出
                                        </button>
                                    </a>
                                    <a href="https://tools.fanhaocms.net">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span
                                                    class="am-icon-plus"></span> 工具箱
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
                                    <th class="table-title">域名</th>
                                    <th class="table-title">名称</th>
                                    <th class="table-date am-hide-sm-only">电脑模板</th>
                                    <th class="table-date am-hide-sm-only">手机模板</th>
                                    <th class="table-date am-hide-sm-only">广告邮箱</th>
                                    <th class="table-date am-hide-sm-only">网站LOGO</th>
                                    <th class="table-set">操作</th>
                                </tr>
                                </thead>
                                <tbody style="word-break: break-all;">
                                <?php

                                $siteGroup_config = CMS_ROOT . 'qita/site_group.json';
                                error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
                                header("Content-type: text/html; charset=utf-8");
                                $json = json_decode(file_get_contents($siteGroup_config), true);
                                //执行删除
                                if(isset($_GET['id'])){
                                    unset($json[$_GET['id']]);
                                    file_put_contents($siteGroup_config,json_encode($json));
                                    exit('<script>alert("删除成功！");location.href="SiteGroup_list.php";</script>');
                                }
                                //域名查找
                                if(isset($_GET['domain'])){
                                    $temp = [];
                                    foreach($json as $key => $item){
                                        foreach ($item['domains'] as $domain){
                                            if(stripos($domain,$_GET['domain'])!==false){
                                                $temp[$key] = $item;
                                                break;
                                            }
                                        }
                                    }
                                    $json = $temp;
                                }
                                if(isset($_POST['import'])){
                                    $import = $_POST['import'];
                                    if(json_decode($import,true)!=null){
                                        file_put_contents($siteGroup_config,$import);
                                        exit('<script>alert("导入成功！");location.href="./SiteGroup_list.php";</script>');
                                    }else{
                                        exit('<script>alert("导入格式或编码不正确！");location.href="./SiteGroup_list.php";</script>');
                                    }

                                }
                                foreach ($json as $key => $item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $item['domains'][0] ?></td>
                                        <td><?php echo $item['title']; ?></td>
                                        <td class="table-date am-hide-sm-only"><?php echo $item['moban_pc']; ?></td>
                                        <td class="table-date am-hide-sm-only"><?php echo $item['moban_wap']; ?></td>
                                        <td class="table-date am-hide-sm-only"><?php echo $item['email']; ?></td>
                                        <td class="table-date am-hide-sm-only"><img src="<?php echo $item['logo']; ?>" height="30"></td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <a href="SiteGroup_edit.php?id=<?php echo $key; ?>"
                                                       class="am-btn am-btn-default am-btn-xs am-text-secondary"><span
                                                                class="am-icon-pencil-square-o"></span> 修改</a>
                                                    <a href="?id=<?php echo $key; ?>"
                                                       onclick="return confirm('确定要删除吗？')"
                                                       class="am-btn am-btn-default am-btn-xs am-text-danger _am-hide-sm-only"><span
                                                                class="am-icon-trash-o"></span> 删除</a>
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
                        <div class="am-modal-hd">输入您要查找的域名</div>
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