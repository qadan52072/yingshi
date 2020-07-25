<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $html_title;?></title>
<link href="css/install.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validation.min.js"></script>
<script type="text/javascript" src="js/jquery.icheck.min.js"></script>
<script>
$(document).ready(function(){
    $('input[type="checkbox"]').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
  });
});

$(function(){
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[^:%,'\*\"\s\<\>\&]+$/i.test(value);
    }, "不得含有特殊字符");
    $("#install_form").validate({
        errorElement: "font",
    rules : {
        admin_path : {required : true},
        site_name : {required : true},
        admin : {required : true,lettersonly : true},
        password : {required : true, minlength : 6},
        rpassword : {required : true,equalTo : '#password'},
      }
    });

    jQuery.extend(jQuery.validator.messages, {
      required: "未输入",
      digits: "格式错误",
      lettersonly: "不得含有特殊字符",
      equalTo: "两次密码不一致",
      minlength: "密码至少6位"
    });

    $('#next').click(function(){
        $('#install_form').submit();
    });

});
</script>
</head>
<body>
<?php echo $html_header;?>
<div class="main">
  <div class="step-box" id="step3">
    <div class="text-nav">
      <h1>Step.2</h1>
      <h2>配置网站</h2>
      <h5>填写站点相关信息</h5>
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
  <form action="" id="install_form" method="post">
    <input type="hidden" value="submit" name="submitform">
    <input type="hidden" value="<?php echo $install_recover;?>" name="install_recover">
    <div class="form-box control-group">
      <fieldset>
        <legend>数据目录信息</legend>
          <div>
              <label>后台目录</label>
              <span>
          <input type="text" name="admin_path" maxlength="40" value="<?php echo isset($_POST['admin_path'])?$_POST['admin_path']:'fhadmin';?>">
          </span> <em>后台目录，请不要设置admin这类容易被扫描的目录名</em></div>
      </fieldset>
      <fieldset>
        <legend>网站信息</legend>
        <div>
          <label>站点名称</label>
          <span>
          <input name="site_name" value="<?php echo $_POST['site_name'];?>" maxlength="100" type="text">
          </span> <em>输入站点名称，安装后可在平台设置中进行修改</em></div>
        <div>
          <label>管理员账号</label>
          <span>
          <input name="admin" value="<?php echo $_POST['admin'];?>" maxlength="20" type="text">
          </span> <em>请不要设置admin这类容易被猜出来的账号</em></div>
        <div>
          <label>管理员密码</label>
          <span>
          <input name="password" id="password" maxlength="20" value="<?php echo $_POST['password'];?>" type="password">
          </span> <em>管理员密码不少于6个字符</em></div>
        <div>
          <label>重复密码</label>
          <span>
          <input name="rpassword" value="<?php echo $_POST['rpassword'];?>" maxlength="20" type="password">
          </span> <em>确保两次输入的密码一致</em></div>
      </fieldset>
    </div>
    <div class="btn-box"><a href="index.php?step=1" class="btn btn-primary">上一步</a><a id="next" href="javascript:void(0);" class="btn btn-primary">下一步</a></div>
  </form>
</div>
<?php echo $html_footer;?>
</body>
</html>
