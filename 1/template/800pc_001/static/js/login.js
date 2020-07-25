 function checkName(name){
            if(name==''){
                reg_status = false;
                hfRegMsg("申请账号不能为空");
                return;
            }else if(name.length<5 || name.length>11){
                reg_status = false;
                hfRegMsg("帐号应5-11个字母,数字组合");
                return;
            }



            $.post('/index.php/api/hf/checkname', {
                name:name
            },
            function (response) {
                if(response == "yes"){
                    //已存在
                    reg_status = false;
                    hfRegMsg("该用户名已存在！");
                    return;
                }else{

                }
            }, 'html');
        }


        function checkPhone(phone){
            var isphone= /^\d{11,12}$/;
            if(phone==''){
                reg_status = false;
                hfRegMsg("手机号不能为空！");
                return;
            }else if(!isphone.test(phone)){
                reg_status = false;
                hfRegMsg("手机号格式不正确！");
                return;
            }


            $.post('/index.php/api/hf/checkphone', {
                phone:phone
            },
            function (response) {
                if(response == "yes"){
                    //已存在
                    reg_status = false;
                    hfRegMsg("该手机号码已存在！");
                    return;
                }else{

                }
            }, 'html');
        }



function login_pop(){
    $("#div_login_reg").fadeOut();
    $("#dialog-login").fadeIn();
    $("#tab-tips-1769").fadeOut();
    $("#div_login_reg").fadeIn();
}
function reg_pop(){
    $("#div_login_reg").fadeOut();
    $("#dialog-login").fadeOut();
    $("#tab-tips-1769").fadeIn();
    $("#div_login_reg").fadeIn();
}

function login_hide(){
    $("#dialog-login").fadeOut();
    $("#tab-tips-1769").fadeOut();
    $("#div_login_reg").fadeOut();
}

function getToken(){
    $.post('/index.php/user/login/ajaxgettoken', {},
            function (response) {
                if(response != ""){
                    $("#dialog-login input[name=token]").val(response);
                    $("#tab-tips-1769 input[name=token]").val(response);
                    if($("#div_login_big").length > 0){
                        $("#div_login_big input[name=token]").val(response);
                    }
                    $("form input[name='token']").val(response);
                }
            }, 'html');
}

function displayVerify(){
    $.post('/index.php/user/reg/showverify', {},
            function (response) {
                if(response.status == "yes"){
                    $("#li_verify ").css("display","");
                    $('#refresh_code').click(function(){
                        $('#code').attr('src', "/index.php/api/codes?" + Math.random());
                    });

                }else{
                    $("#li_verify ").css("display","none");
                }
            }, 'json');
}

function showMsg(info){
    $("#div_msg").html(info);
    if(info == ""){
    }else{
        $("#msg_bt").trigger("click");
    }
}

function loginMsgTop(info)
{
    showMsg(info);
}

function loginMsg(info){
    if(info == ""){
        $("#div_login_msg").html(info);
        $("#div_login_msg").css("display","none")
    }else{
        $("#div_login_msg").html('<i class="fa fa-warning"></i> '+info);
        $("#div_login_msg").css("display","");
    }

}

function regMsg(info){
    if(info == ""){
        $("#div_reg_msg").css("display","none")
    }else{
        $("#div_reg_msg").html('<i class="fa fa-warning"></i> '+info);
        $("#div_reg_msg").css("display","");
    }
}
function hfRegMsg(info){
    if(info == ""){
        $("#error_info").css("display","none")
    }else{
        $("#error_info").html('<i class="fa fa-warning"></i> '+info);
        $("#error_info").css("display","");
    }
}
//获取列表视频id
function getVideoIds(){
    var ids = [];
    $("span[id*='span_zan_']").each(function(){
        var id = $(this).attr('id');
        var id_split  = id.split('_');
        var vid = id_split[2];
        ids[ids.length]=vid;
    });
    return ids;
}
//批量获得点赞数
function getDhits(ids){
    if(ids.length < 1){
        ids = getVideoIds();
    }
    if(ids.length > 0){//有需要获得点赞数的视频
        $.post('/index.php/dhits/getdhit', {
                 ids:ids
             },
            function (response) {
                if(response.length > 0){
                    for(var i=0; i<response.length; i++){
                        var k=response[i].id;
                        var v=response[i].dhits;
                        $("#span_zan_"+k).html(v);
                    }

                }
            }, 'json');



    }



}
//获取热门搜索
function getHotSearch(){
    $.post('/index.php/hotsearch/get', {},
        function (response) {
            if(response.length > 0){
                $("#div_hot").remove();
                $("#div_search").after(response);
            }
        }, 'html');

}


$(document).ready(function() {
    //初始化获取token
    //getToken();
 //判断是否显示验证码
    //displayVerify();


//登录
    $("#login_bt").click(function(){
        var token = $("#dialog-login input[name=token]").val();
        $.post('/index/user/user_login', {
                 token:token,
                 username:$("#dialog-login input[name=username]").val(),
                 password:$("#dialog-login input[name=password]").val(),
                 remember:1

             },
            function (response) {
                if(response.code != 1){
                    loginMsg(response.msg);
                }else{
                    //验证通过，提交表单
                    loginMsg("登录成功！正在转向。。。");
                    //msvod_login();
                    window.location.reload();
                }
            }, 'json');


    });
//注册
var common_reg_bt_status = true;
    $("#reg_bt").click(function(){
        var token = $("#tab-tips-1769 input[name=token]").val();
        var username = $("#tab-tips-1769 input[name=username]").val();
        var userpass = $("#tab-tips-1769 input[name=userpass]").val();
        var repassword = $("#tab-tips-1769 input[name=repassword]").val();
        var useremail = $("#tab-tips-1769 input[name=useremail]").val();

        var param = {
                 token:token,
                 username:username,
                 password:userpass,
                 password_c:repassword,
                 email:useremail

             };

        if(username.length<4 || username.length>12){
            regMsg("用户名格式不对,4-12位字符！");
            return;
        }
        /*
        if (escape(username).indexOf("%u") !=-1){
            regMsg("用户名只支持输入字母和数字！");
            return;
        }*/
        if(userpass.length < 6 || userpass.length > 16){
            regMsg("密码长度不对！");
            return;
        }
        if(userpass != repassword){
            regMsg("两次输入密码不一致！");
            return;
        }

        //var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
        var reg =  new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
            if (!reg.test(useremail)) {
                regMsg('邮箱格式不正确，请重新填写!');
               return;
          }


        if(!$("#tab-tips-1769 input[name=age]").is(':checked')){
            regMsg("请确认年龄已超过 18 岁");
            return;
        }else{
            param.age="1";
        }
        if(!$("#tab-tips-1769 input[name=agree]").is(':checked')){
            regMsg("请确认同意 服务条款 以及 隐私条款");
            return;
        }else{
            param.agree="1";
        }

        if(!$("#li_verify").is(":hidden")){
            param.usercode = $("#usercode").val();
        }

        if(common_reg_bt_status){
            common_reg_bt_status = false;
            regMsg("信息提交中...");
            $.post('/index/user/user_reg', param,
                function (response){
                    common_reg_bt_status = true;
                    if(response.code != "1"){
                        //alert(response.info);
                        //loginMsg(response.info);
                        $("#div_reg_msg").html(response.msg);
                        $("#div_reg_msg").css("display","");
                        return false;
                    }
                    if(response.code == "1"){
                        //验证通过，提交表单
                        //loginMsg("");
                        login_hide();
                         //msvod_login();
                        //$("#div_reg_msg").html("注册成功");
                        //$("#div_reg_msg").css("display","none");
                        window.location.reload();
                    }
                }, 'json');
        }

    });

var reg_status = true;//true:可以注册，false：不能注册

//用户名触发
$("#tab-tips-hf #loginname").blur(function(){
    var name = $("#tab-tips-hf #loginname").val();
    checkName(name);
});
//手机号触发
$("#tab-tips-hf #phone").blur(function(){
    var phone = $("#tab-tips-hf #phone").val();
    checkPhone(phone);
});


//注册恒峰
$("#hf_reg_bt").click(function(){
                reg_status = true;
                var name = $("#tab-tips-hf #loginname").val();
                var password = $("#tab-tips-hf #pwd").val();
                var repassword = $("#tab-tips-hf #repwd").val();
                var phone = $("#tab-tips-hf #phone").val();

                //验证用户名有效性
                checkName(name);

                if(password==''){
                    reg_status = false;
                    hfRegMsg('登录密码不能为空');
                    return;
                }else if(password.length<8 || password.length>16){
                    reg_status = false;
                    hfRegMsg('密码长度须在8~16位之间');
                    return;
                }
                if(repassword != password){
                   reg_status = false;
                   hfRegMsg('两次输入密码不一致！');
                   return;
                }
                /*
                 var isphone= /^\d{11,12}$/;
                    if(phone==''){
                        reg_status = false;
                        layer.alert('联系电话不能为空');
                        return;
                    }else if(!isphone.test(phone)){
                        reg_status = false;
                        layer.alert('电话长度应用为11~12位正确的手机号');
                        return;
                    }
                 */

                //验证手机号有效性
                checkPhone(phone);

                if(reg_status){
                    var form = document.getElementById("realAccount");
                    form.submit();
                }

            });





//获得视频点赞数
//getDhits([]);

//获得热门搜索
//getHotSearch();





});

