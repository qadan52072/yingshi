<?php

session_start();//首先要启动session
header('Content-type:image/jpeg');
$width=60;
$height=20;
$element=array('a','b','c','d','e','f','g','h','j','k','m','n','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','J','K','M','N','P','Q','R','S','T','U','V','W','X','T','Z','2','3','4','5','6','7','8','9');
$string='';
for ($i=0;$i<4;$i++){
	$string.=$element[rand(0,count($element)-1)];
}
$img=imagecreatetruecolor($width, $height);
$colorBg=imagecolorallocate($img,rand(200,255),rand(200,255),rand(200,255));
$colorBorder=imagecolorallocate($img,rand(200,255),rand(200,255),rand(200,255));
$colorString=imagecolorallocate($img,rand(10,100),rand(10,100),rand(10,100));
imagefill($img,0,0,$colorBg);
imagerectangle($img,0,0,$width-1,$height-1,$colorBorder);
for($i=0;$i<100;$i++){
	imagesetpixel($img,rand(0,$width-1),rand(0,$height-1),imagecolorallocate($img,rand(100,200),rand(100,200),rand(100,200)));
}
for($i=0;$i<3;$i++){
	imageline($img,rand(0,$width/2),rand(0,$height),rand($width/2,$width),rand(0,$height),imagecolorallocate($img,rand(100,200),rand(100,200),rand(100,200)));
}
imagestring($img,5,rand(1,15),0,$string,$colorString);
$_SESSION['yzm'] = $string;
imagejpeg($img);
imagedestroy($img);

