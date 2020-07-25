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
                <li>友链设置</li>
				 <li class="am-active">友链管理</li>
            </ol>
<div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 友链管理
                    </div>



                </div>
                <div class="tpl-block">
                    <div class="am-g">
                        <div class="am-u-sm-12 am-u-md-6">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <form method="post" action="">
                                        <input type="hidden" name="import" value="">
                                        <a href="connection_add.php"><button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button></a>
                                        <a href=""><button type="button" class="am-btn am-btn-default am-btn-success" style="position: relative;overflow: hidden"><span class="am-icon-upload"></span> 导入<input type="file" id="list" style="position: absolute;top: 0;left: 0;height: 100%;width: 100%;z-index: 999;opacity: 0"></button></a>
                                        <a href="javascript:;" onclick="exportLink()"><button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-download"></span> 导出</button></a>
                                    </form>



                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="am-g">
                        <div class="am-u-sm-12">
                            <form class="am-form">
                                <table class="am-table am-table-striped am-table-hover table-main">
                                    <thead>
                                        <tr>
                                            <th class="table-title">排序</th>
                                            <th class="table-title">友链标题</th>
                                            <th class="table-type">友链地址URL</th>
                                            <th class="table-date am-hide-sm-only">备注</th>
                                            <th class="table-set">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>	
									
<?php
$linkfile = CMS_ROOT."connection/connection.json";
$json = json_decode(file_get_contents($linkfile),true);
//导入
if(isset($_POST['import'])){
    $import = $_POST['import'];
    $import = explode("\n",$import);
    $import = array_filter($import);
    foreach ($import as $index=>$item){
        $tmp = explode('|',$item);
        if(sizeof($tmp)==2){
            $key = time().rand(100,999);
            $data = [
                    'id'=>$key,
                    'sort'=>$index+1,
                    'title'=>$tmp[0],
                    'url'=>$tmp[1],
                    'remark'=>''
            ];
            $json[$key] = $data;
        }
    }
    file_put_contents($linkfile,json_encode($json));
    exit('<script>alert("导入成功！");location.href="connection.php";</script>');
}
//删除
if(isset($_GET['id'])){
    unset($json[$_GET['id']]);
    file_put_contents($linkfile,json_encode($json));

    exit('<script>alert("删除成功！");location.href="connection.php";</script>');
}
$json = jsonsort($json);

	foreach ($json as $item){
?>
                                        <tr>
                                            <td><?php echo $item['sort'];?></td>
                                            <td><?php echo $item['title'];?></td>
                                            <td><?php echo $item['url'];?></td>
											<td class="am-hide-sm-only"><?php echo $item['remark'];?></td>
                                            <td>
                                                <div class="am-btn-toolbar">
                                                    <div class="am-btn-group am-btn-group-xs">
                                                        <a href="connection_mod.php?id=<?php echo $item['id'];?>" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                                        <a href="?id=<?php echo $item['id'];?>" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</a>
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
                </div>
                <div class="tpl-alert"></div>
            </div>        </div>
				<?php include('../admin_config/admin_foot.php');?>
    </div>
	
    <script src="<?php echo CMS_ADMIN_url;?>assets/js/jquery.min.js"></script>
    <script src="<?php echo CMS_ADMIN_url;?>assets/js/amazeui.min.js"></script>
    <script src="<?php echo CMS_ADMIN_url;?>assets/js/iscroll.js"></script>
    <script src="<?php echo CMS_ADMIN_url;?>assets/js/app.js"></script>
    <script>
        $('#list').on('change',function () {
            var file = document.querySelector('#list').files[0];
            var filereader = new FileReader();
            filereader.readAsText(file,'utf-8');
            filereader.onloadend = function (ev) {
                document.querySelector('input[name=import]').value = ev.target.result;
                //console.log(ev.target.result)
                if(encodeURI(ev.target.result).indexOf('%EF%BF%BD')>-1){
                    filereader.readAsText(file,'gb2312');
                }else{
                    document.forms[0].submit();
                }
            }
        })
        function exportLink() {
            var exportData = [];
            $('tbody tr').each(function (i,v) {
                var tmp = $(v).find('td').eq(1).text().replace(/\n/g,'')+'|'+$(v).find('td').eq(2).text().replace(/\n/g,'');
                exportData.push(tmp);
            });
            var str = exportData.join("\n");
            var blob = new Blob([str],{type:'application/octet-stream;charset=gb2312'});
            var downLink = document.createElement('a');
            downLink.href = URL.createObjectURL(blob);
            downLink.download = 'ulink_'+(new Date().getTime())+'.txt';
            document.body.appendChild(downLink);
            downLink.click();
        }
    </script>
  </body>

</html>