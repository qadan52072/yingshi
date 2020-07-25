<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $html_title;?></title>
<link href="css/install.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
<link href="css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
<script type="text/javascript">
var scroll_height = 0;
function showmessage(message) {
    document.getElementById('license').innerHTML += message+"<br/>";
    document.getElementById("text-box").scrollTop = 500+scroll_height;
    scroll_height += 40;
}
$(document).ready(function(){
    //自定义滚定条
    $('#text-box').perfectScrollbar();
});
</script>
</head>

<body>
<?php echo $html_header;?>
<div class="main">
  <div class="step-box" id="step4">
    <div class="text-nav">
      <h1>Step.3</h1>
      <h2>安装数据库</h2>
      <h5>正在安装程序</h5>
    </div>
    <div class="procedure-nav">
      <div class="schedule-ico"><span class="a"></span><span class="c"></span><span class="d"></span></div>
      <div class="schedule-point-now"><span class="a"></span><span class="c"></span><span class="d"></span></div>
      <div class="schedule-point-bg"><span class="a"></span><span class="c"></span><span class="d"></span></div>
      <div class="schedule-line-now"><em></em></div>
      <div class="schedule-line-bg"></div>
      <div class="schedule-text"><span class="a">检查安装环境</span><span class="c">配置网站</span><span class="d">安装</span></div>
    </div>
  </div>
  <div class="text-box" id="text-box">
    <div class="license" id="license"></div>
  </div>
  <div class="btn-box"><a href="javascript:void(0);" id="install_process" class="btn btn-primary">正在安装 ...</a></div>
</div>
<script>
    (function () {
        showmessage('正在安装后台...' );
        $.ajax({
            url:"",
            type:"post",
            data:"m=rename",
            success:function (data) {
                showmessage('正在写入配置...' );
                $.ajax({
                    url:"",
                    type:"post",
                    data:"m=config",
                    success:function (data) {
                        showmessage('正在初始化数据...' );
                        $.ajax({
                            url:"",
                            type:"post",
                            data:"m=finish",
                            success:function (data) {
                                showmessage('安装完成!' );
                                document.getElementById('install_process').innerHTML = '安装完成，下一步...';
                                document.getElementById('install_process').href='index.php?step=4&sitename=<?php echo $_SESSION['sitename'];?>&username=<?php echo $_SESSION['admin'];?>&password=<?php echo $_SESSION['password'];?>&adminpath=<?php echo $_SESSION['admin_path'];?>'
                            }
                        })
                    }
                })
            }
        })
    })();
</script>
<?php echo $html_footer;?>
</body>
</html>
