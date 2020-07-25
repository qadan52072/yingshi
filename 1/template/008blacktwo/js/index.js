$(function(){
        // 公告栏 文字滚动
        var begin2 = 0;
        var marquee = $('.marquee p');
        var wideMarquee = parseInt(marquee.width());
        $('.marquee').append(marquee.clone(true));

            var roll2 = setInterval(function () {
            begin2 -= 1;
            marquee.css({ 'margin-left': begin2 + 'px' })
            if (-begin2 >= wideMarquee) {
                begin2 = 0;
            }
        }, 20);
    
});