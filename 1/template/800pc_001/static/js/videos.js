var GET = $.urlGet();

$(document).ready(function() {



//默认是否展开标签区域
if(GET['tag'] < 35 || GET['tag_type'] <6){
    tags_down();
}


//标签下拉按钮
$("#more_down").click(function(){
    if($("#tags_div").outerHeight() < 300){
        tags_down();

    }else{
        tags_up();
    }

});

function tags_down(){
    $("#tags_div").animate({ height: '400px' }, 300);
    $("#tags_down").html("收起");
    $("#more_down").removeClass("more-down").addClass("more-up");
}
function tags_up(){
    $("#tags_div").animate({ height: '148px' }, 300);
        $("#tags_down").html("展开更多");
    $("#more_down").removeClass("more-up").addClass("more-down");
}

//时间筛选
$("#time_select").change(function(){
    var v=$(this).val();
    window.location.href=makeUrl("time",v);
});
//条件筛选
$("#sort_new").click(function(){
    sortUrl($(this),'new');
});
$("#sort_hot").click(function(){
    sortUrl($(this),'hot');
});
$("#sort_ping").click(function(){
    sortUrl($(this),'ping');
});
$("#sort_cang").click(function(){
    sortUrl($(this),'cang');
});












});