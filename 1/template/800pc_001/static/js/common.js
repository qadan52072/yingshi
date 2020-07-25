/* tip reg */
$(document).ready(function(){
	/* 注册1769和注册恒峰弹窗 */
  $(".button-reg-hf").click(function(){
	 $(".dialog-reg-tab a:first").removeClass("mdui-tab-active");
    $(".dialog-reg-tab a:last").addClass("mdui-tab-active");
	  document.getElementById( "tab-tips-1769" ).style.display="none";
	  document.getElementById( "tab-tips-hf" ).style.display="block";
  });


/* 返回顶部 */
var top=document.getElementById("btn-top");
   var bottom=document.getElementById("btn-top");
   top.onclick=function(){
       timer=setInterval(function(){
           var scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
           var ispeed=Math.floor(-scrollTop/10);
           console.log(ispeed)
           if(scrollTop==0){
               clearInterval(timer);
           }
           document.documentElement.scrollTop=document.body.scrollTop=scrollTop+ispeed;
       },30)
   };


});





