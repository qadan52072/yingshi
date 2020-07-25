<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
  <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0,user-scalable=no" />
  <meta name="renderer" content="webkit" />
	<title>{cmsobj_name}-文章内容-{cms_title}</title>
	<meta name="keywords" content="{cms_keywords}" />
	<meta name="description" content="{cms_description}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{cms_template}/css/index.css" />
</head>
<body>
{include file="header.php"}

  <main class="main" style="padding: 10px 8px 8px 8px;"> 
   <div id="propagandaInsert" class="flex-row cross_line"></div> 
   <div id="propagandaBottom"></div>
       <h1 class="h1">您的位置：图片专区{cmsobj_name}</h1>
  <section class="videos" >
  <style>
  fieldset, img {

    border: none;
    display: block;
    width: 95% !important;
    height: auto !important;
    margin: 16px auto;
}
  </style>
  
  
  {cmsobj_content}</section>


  </main>{include file="footer.php"}
 
</body>
</html>
