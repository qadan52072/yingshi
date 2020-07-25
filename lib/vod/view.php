<?php
$data = getDataById('vod',$C_T_3);
$tpl->assign('page','1');
$tpl->assign('data',getListByType('vod',getValueByKey($data,0,'type'),true));
$tpl->assign('type_id',getValueByKey($data,0,'type'));

$tpl->assign('cmsobj_id',$C_T_3);
$tpl->assign('cmsobj_name',getValueByKey($data,0,'name'));
$tpl->assign('cmsobj_typename',getTypeById('vod',getValueByKey($data,0,'type')));
$tpl->assign('cmsobj_hit',rand(5, 10000));
$tpl->assign('cmsobj_time',getValueByKey($data,0,'time'));
$tpl->assign('cmsobj_view',U($C_T_0,'view',$C_T_2,$C_T_3));
$tpl->assign('cmsobj_typemore',U($C_T_0,'type',getValueByKey($data,0,'type'),'1'));

$tpl->assign('cmsobj_pic',getValueByKey($data,0,'pic'));
$url = getValueByKey($data,0,'playurl');
$tpl->assign('cmsobj_url',$url);
$player = <<<tag
<div id='preVideo'  style="width: 100%;height: 100%;display:none"></div>
<div id='myVideo'  style="width: 100%;height: 100%"></div>
<script src="/static/hls.min.js"></script>
<script src="/static/DPlayer.min.js"></script>
<script type="text/javascript">
    window.videojs = {
        dom:{
            createEl:function(tag,obj,arg,sub) {
              var el = document.createElement(tag);
              for(var k in arg){
                  el.setAttribute(k,arg[k]);
              }
              el.append(sub);
            }
        }
    }
	var myVideo = new DPlayer({
    container: document.getElementById('myVideo'),
    screenshot: true,
    logo: '{$cms_system['cms_logo']}',
    video: {
        url: '$url',
        type: 'customHls',
        autoplay:false,
        customType: {
            customHls: function (video, player) {
                const hls = new Hls();
                hls.loadSource(video.src);
                hls.attachMedia(video);
            },
        },
    },
});
	myVideo.currentTime = function() {
	  return myVideo.video.currentTime;
	}
</script>
tag;
$tpl->assign('cmsobj_content',$player);

$plug->listen('vod_view','before');
$tpl->show('view');
$plug->listen('vod_view','after');
?>