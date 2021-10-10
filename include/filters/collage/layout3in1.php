<?php
$dst = @imagecreatetruecolor(585, 1033);
imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));
$src_width = imagesx($src_img);
$src_height = imagesy($src_img); 
$dst_width = 585;
$dst_height = 1033;
$new_width = $dst_width;
//$new_height = round($new_width*($src_height/$src_width));
$new_x = 0;
$new_height=1033;
$new_y=0;
//$new_y = round(($dst_height-$new_height)/2);
//$next = $new_height < $dst_height;
//if ($next) {
$new_height = $dst_height;
$new_width = round($new_height*($src_width/$src_height));
$new_x = round(($dst_width - $new_width)/2);
$new_y = 0;
//}
imagecopyresampled($dst, $src_img , 0, 0, 0, 0, 585, 1033, $src_width, $src_height);
$im = @imagecreatetruecolor(2400, 1600); 
$png = SERVER_PATH."include/props/23.png"; 
$effect = imagecreatefrompng($png); 
imagecopy ($effect,$dst,930,278,0,0,585,1033);
imagecopyresampled ($im,$effect,0,0,0,0,2400,1600,2400,1600);
$black = imagecolorallocate($im, 0, 0, 0);
imagecolortransparent($im, $black);
$mobile=$im;
// tablet
$dst = @imagecreatetruecolor(515, 710);
imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));
$src_width = imagesx($src_img);
$src_height = imagesy($src_img); 
$dst_width = 515;
$dst_height = 710;
$new_width = $dst_width;
$new_height = round($new_width*($src_height/$src_width));
$new_x = 0;
$new_y = round(($dst_height-$new_height)/2);
$next = $new_height < $dst_height;
if ($next) {
$new_height = $dst_height;
$new_width = round($new_height*($src_width/$src_height));
$new_x = round(($dst_width - $new_width)/2);
$new_y = 0;
}
imagecopyresampled($dst, $src_img , 0, 0, 0, 0, 515, 710, $src_width, $src_height);
$im = @imagecreatetruecolor(1500, 1000); 
 
$png = SERVER_PATH."include/props/21.png"; 
$effect = imagecreatefrompng($png); 
imagecopy ($effect
,$dst,505,150,0,0,515,710);
imagecopyresampled ($im,$effect,0,0,0,0,1500,1000,1500,1000);
$black = imagecolorallocate($im, 0, 0, 0);
imagecolortransparent($im, $black);
$tablet=$im;

$dst = @imagecreatetruecolor(1000, 750);
$black = imagecolorallocate($dst, 0, 0, 0);
imagecolortransparent($dst, $black);
imagecopyresampled($dst, $mobile , 0, 0, 0, 0, 1000, 750, 2400, 1600);
imagecopy ($tablet,$dst,-50,250,0,0,1000,750);
$im=$tablet;
?>