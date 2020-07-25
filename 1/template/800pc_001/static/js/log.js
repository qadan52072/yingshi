    //验证单点登录
    var login_check ;

$(document).ready(function() {
    var pid="";
    if(typeof(pageid)!='undefined'){
        pid = pageid;
    }
    //$.get("/index.php/api/log/index", {pid: pid} );

    // login_check = setInterval("relogin_msg()",30000);
    

});

// function relogin_msg(){
//     $.get("/ajax.php?login=d",{},function(data){
//         if(data == "relogin"){
//             var relogin_msg = "该1769账号在另一台设备登录，目前登录已失效，请重新登录！";
//             if($("#msg_bt").length > 0){
//                 $("#div_msg").html(relogin_msg);
//                 $("#msg_bt").trigger("click");
//             }else{
//                 alert(relogin_msg);
//             }
//             window.clearInterval(login_check);
//         }
//     });
// }

//vip视频跳转地址
function vip_href(obj){
    var href = $(obj).attr("dhref");
    if(isVip == 1){
        $(obj).attr("href",href);
        $(obj).trigger("click");
    }else{
        if($("#msg_bt_vip").length>0){
            $("#msg_bt_vip").trigger("click");
            $("#msg_bt_jifen").attr("href",href);
        }  
    }
    
}

