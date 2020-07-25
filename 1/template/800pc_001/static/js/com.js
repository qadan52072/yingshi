(function($) {
$.extend({
urlGet:function()
{
  var aQuery = window.location.href.split("?");  //取得Get参数
  var aGET = new Array();
  if(aQuery.length > 1)
  {
    var aBuf = aQuery[1].split("&");
    for(var i=0, iLoop = aBuf.length; i<iLoop; i++)
    {
      var aTmp = aBuf[i].split("=");  //分离key与Value
      aGET[aTmp[0]] = aTmp[1];
    }
  }
  return aGET;
 }
})
})(jQuery);

//根据传参flag=value替换参数或追加到url
function makeUrl(flag,value){
    var str = window.location.search;
    str = str.replace("?","");
    var ret="?";
    var str_arr = str.split("&");
        $.each(str_arr,function(k,v){
            var v_arr = v.split("=");
            if(v_arr[0] != flag && v_arr[0] != ""){
                if(k == 0){
                    ret += v_arr[0] + "=" + v_arr[1];
                    ret +="&";
                }else{
                    ret += v_arr[0] + "=" + v_arr[1];
                    ret +="&";
                }
                
            }
            
        });
        ret += flag + "=" + value;

    ret = window.location.protocol + "//" + window.location.host + window.location.pathname + ret;
    return ret;
}

//条件筛选指向
function sortUrl(obj,sort){
    var c = $(obj).attr("class");
    if(c == "active"){
        var s = sort+"_r";
    }else{
        var s = sort;
    }
    window.location.href=makeUrl("sort",s);
    
}
