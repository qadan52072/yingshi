<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>注册 - {cms_title}</title>
    <meta name="description" content="{cms_description}" />
    <meta name="keywords" content="{cms_keywords}" />
    {include file="include.php"}
</head>
<body>
{include file="header.php"}

<div class="qr-content">
    <div class="qr-block qr-block-title">
        <span  class="title-bg"> <i class="layui-icon layui-icon-user"></i> 用户注册</span>
    </div>
    <div class="row">
        <div class="col-sm-12" style="padding: 16px 0">
            <form action="" method="post" class="layui-form  layui-form-pane">
                <div class="layui-form-item">
                    <label class="layui-form-label">验证码</label>
                    <div class="layui-input-inline">
                        <input type="text" name="verifycode" required  lay-verify="required" placeholder="请输入验证码" autocomplete="off" class="layui-input">

                    </div>
                    <img src="/lib/class/yzm.php" style="height: 38px;" onclick="this.src = '/lib/class/yzm.php?t='+(new Date()).getTime()">
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">邮箱</label>
                    <div class="layui-input-inline">
                        <input type="text" name="email" required  lay-verify="required" placeholder="请输入邮箱" autocomplete="off" class="layui-input">

                    </div>
                    <button type="button" class="layui-btn layui-btn-success sendcode" >发送验证码</button>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">邮箱验证码</label>
                    <div class="layui-input-block">
                        <input type="text" name="emailcode" required  lay-verify="required" placeholder="邮箱验证码" autocomplete="off" class="layui-input">

                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-block">
                        <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">确认密码</label>
                    <div class="layui-input-block">
                        <input type="password" name="repassword" required lay-verify="required" placeholder="确认密码" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn layui-btn-success submit">注册</button>
                        <a href="{:U('user','login',1,1)}" class="layui-btn layui-btn-success">去登录</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    window.onload = function () {
        layui.use(['jquery'],function () {
            var $ = layui.jquery;
            $('.close-plus').on('click',function () {
                $(this).toggleClass('active');
                $(this).parent().next().toggleClass('active')
            })
            $('.sendcode').on('click',function () {
                if($('.sendcode').text()=='发送验证码'){
                    if($('input[name=email]').val()!=''&&$('input[name=verifycode]').val()!=''){
                        $.ajax({
                            type:'post',
                            url:'',
                            data:'email='+$('input[name=email]').val()+'&verifycode='+$('input[name=verifycode]').val(),
                            success:function (data) {
                                console.log(data.success);
                                if(!!data.success){
                                    $('.sendcode').prop('readonly',true);
                                    $('.sendcode').text('60');
                                    var buttonTimer = setInterval(function () {
                                        if($('.sendcode').text()==0){
                                            $('.sendcode').prop('readonly',false);
                                            $('.sendcode').text('发送验证码');
                                            clearInterval(buttonTimer);
                                        }else{
                                            $('.sendcode').text($('.sendcode').text()-1);
                                        }

                                    },1000)
                                }else{
                                    layer.msg(data.msg);
                                }
                            }
                        })
                    }else{
                        layer.msg('信息填写不完整');
                    }
                }
            })
            $('.submit').on('click',function () {
                if($('input[name=password]').val()!=$('input[name=repassword]').val()){
                    layer.msg('两次输入密码不一致');
                    return false;
                }
                if($('input[name=password]').val().length<6){
                    layer.msg('密码至少需要六位数');
                    return false;
                }
            })
        })
    }
</script>
{include file="footer.php"}