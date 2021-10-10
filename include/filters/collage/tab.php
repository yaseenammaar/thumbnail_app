<?php
$dst = @imagecreatetruecolor(515,800);
imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));
$src_width = imagesx($src_img);
$src_height = imagesy($src_img); 
$dst_width = 515;
$dst_height = 800;
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
imagecopyresampled($dst, $src_img , 0, 0, 0, 0, 515, 800, $src_width, $src_height);
// $im=$dst;
$im = @imagecreatetruecolor(1500, 1000); 
 
$png = SERVER_PATH."include/props/21.png"; 
$effect = imagecreatefrompng($png); 
imagecopy ($effect
,$dst,505,150,0,0,515,800);
/*for debug

*/
// imagecopy ($im,$dst,50,180,0,0,1500,1000);
// imagecopymerge ($im,$effect,0,0,0,0,1500,1000,0); 
imagecopyresampled ($im,$effect,0,0,0,0,1500,1000,1500,1000);
$black = imagecolorallocate($im, 0, 0, 0);
imagecolortransparent($im, $black);
//imagecopy ($im,$dst,505,150,0,0,510,705);
//imagecopyresampled ($im,$im,0,0,0,0,1500,1000,1500,1000);
?>