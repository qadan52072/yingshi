<!DocType html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>
        {cms_title}
    </title>
    <meta name="keywords" content="{cms_keywords}" />
    <meta name="description" content="{cms_description}" />
    <link href="{cms_template}/css/style.css" rel="stylesheet">
    <link href="{cms_template}/css/style2.css" rel="stylesheet">
    <meta name="theme-color" content="#ffffff">
    <style>
        .title {
            font-size: 20px;
            color: #222222;
            margin-bottom: 5px;
        }

        .title-box {
            border-bottom: 1px solid #ff8000;
        }

        .pagenation a {
            color: black;
        }

        .pagenation a:hover {
            color: ff8000;
            text-decoration: none;
        }
    </style>
</head>

<body data-host="221" class="list hd" data-uid="">
    {include file="header.php"}

    {video_hot}
        <div class="alert alert-default text-center " style="margin:10px 4px 0 4px;padding:0" id="domaintip">
            <div class="dropdown">
                {type_name}
            </div>
        </div>
         {video_list:10}
            <div class="video" id="v_VuHKbdWnH2">
                <a href=" {list_view}">
                    <div class="vimg">
                        <img src="{list_pic}">
                        <span class="vlen">上架时间：
                    {list_time}</span><span class="icon_promote icon_promote_right"
                                                                                 style="width:100%;height:100%"><span>店长推荐</span></span>
                    </div>
                    <p class="title"><span class="glyphicon glyphicon-hd-video" style="color:#337ab7"></span>
                        {list_name}
                    </p>
                </a>
            </div>

        		 {/video_list}

    {/video_hot}




    {if $cms_config['live_status']=='1'}

        <div class="alert alert-default text-center " style="margin:10px 4px 0 4px;padding:0" id="domaintip">
            <div class="dropdown">直播推荐</div>
        </div>

        {live_hot_list:12}


            <div class="video" id="v_VuHKbdWnH2">
                <a href=" {list_view}">
                    <div class="vimg">
                        <img src=" {list_pic}">
                        <span class="vlen">本站提供</span><span class="icon_promote icon_promote_right" style="width:100%;height:100%"><span>时时直播</span></span>
                    </div>
                    <p class="title"><span class="glyphicon glyphicon-hd-video" style="color:#337ab7"></span>
                         {list_name}
                    </p>
                </a>
            </div>

        		 {/live_hot_list}

    {/if}





    <div class="footer">
        <div id="flinks">
            <h5>友情链接</h5>
            <p>
                 {cms_link}
            </p>

        </div>
    </div>



    {include file="footer.php"}

</body>

</html>