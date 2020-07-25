<div class="layui-box layui-laypage layui-laypage-default">
    <a href="{cms_page:first}" class="">首页</a>&nbsp;
    <a href="{cms_page:prev}" class="layui-laypage-prev">上一页</a>&nbsp;
    <a href="{cms_page:next}" class="layui-laypage-next">下一页</a>&nbsp;
    <a href="{cms_page:last}" class="">尾页</a>
</div>
    <select class="toPage " style="outline: none;width: 100px;height: 32px;">

    </select>
    <script>
        var data_url = "{:U($cms_controller,'type',$cms_arga,'page')}";
        var toPage = document.querySelector('.toPage');
        for (var i = 0;i<{cms_page:count};i++){
            var option = document.createElement('option');
            var n = i+1;
            option.innerText = "第"+n+"页";
            option.value = n;
            if(n == {cms_page:current}){
                option.selected = true;
            }
            toPage.appendChild(option);
        }
        toPage.addEventListener("change",function () {
            location.href = data_url.replace('page', this.value);
        })
    </script>