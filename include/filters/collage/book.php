<?php
// new
$outputfi=SERVER_PATH."uploads/".time().rand(11,99).'.png';
$dst = @imagecreatetruecolor(600,1050);
imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));
$src_width = imagesx($src_img);
$src_height = imagesy($src_img); 
$dst_width = 600;
$dst_height = 1050;
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
imagecopyresampled($dst, $src_img , $new_x, $new_y, 0, 0, $new_width, $new_height, $src_width, $src_height);
imagepng($dst,$outputfi, 9);
imagedestroy($dst);
//imagemagick
$nefile=time().rand(11,99).'.png';
$cmd = " {$outputfi} -matte -background none ".
" -virtual-pixel background ".
" -distort Perspective \"0,0 20,20 500,0 500,0 500,1050 500,1050 0,1050 20,1050\" ".
" -trim ".SERVER_PATH."uploads/".$nefile;
exec("convert $cmd ");
$src_img = imagecreatefrompng(SERVER_PATH."uploads/".$nefile);
$im = @imagecreatetruecolor(1500, 1383); 
imagecopy ($im,$src_img,390,115,0,0,1500,1383); 
$png = SERVER_PATH."include/props/26.png";  
$effect = imagecreatefrompng($png); 

//for debug
// imagecopymerge ($im,$effect,0,0,0,0,1500,1383,50); 
imagecopyresampled ($im,$effect,0,0,0,0,1500,1383,1500,1383); 
?>