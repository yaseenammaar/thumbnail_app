<?php
session_start();
$outputfi=SERVER_PATH."uploads/".time().rand(11,99).'.png';
$dst = @imagecreatetruecolor(693, 998);
imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));
$src_width = imagesx($src_img);
$src_height = imagesy($src_img); 
$dst_width = 693;
$dst_height = 998;
$new_width = $dst_width;
//$new_height = round($new_width*($src_height/$src_width));
$new_x = 0;
$new_height=998;
$new_y=0;
//$new_y = round(($dst_height-$new_height)/2);
//$next = $new_height < $dst_height;
//if ($next) {
$new_height = $dst_height;
$new_width = round($new_height*($src_width/$src_height));
$new_x = round(($dst_width - $new_width)/2);
$new_y = 0;
//}
imagecopyresampled($dst, $src_img , 0, 0, 0, 0, 693, 998, $src_width, $src_height);
// $im=$dst;
imagepng($dst,$outputfi, 9);
imagedestroy($dst);
$nefile=time().rand(11,99).'.png';
$cmd = " {$outputfi} -matte -virtual-pixel transparent -interpolate Spline -distort Perspective '0,0 0,0   300,0 300,23   300,300 301,310   0,900 0,900' ".SERVER_PATH."uploads/".$nefile;
exec("convert $cmd ");
$dst = imagecreatefrompng(SERVER_PATH."uploads/".$nefile);
$im = @imagecreatetruecolor(2000,1334); 
 
$png = SERVER_PATH."include/props/27.png"; 
$effect = imagecreatefrompng($png);
$src_width = imagesx($dst);
$src_height = imagesy($dst); 
imagecopy ($effect,$dst,715,167,0,0,$src_width,$src_height);
/*for debug

*/
imagecopyresampled ($im,$effect,0,0,0,0,2000,1334,2000,1334);
$black = imagecolorallocate($im, 0, 0, 0);
imagecolortransparent($im, $black);
$backimage=$im;
if(isset($_SESSION['sidebar'])){
     switch($_SESSION['ext'])
	{
		case 'png':
			$sideimage =  imagecreatefrompng(SERVER_PATH.'uploads/'.$_SESSION['sidebar']);
			break;
		case 'gif':
			$sideimage =  imagecreatefrompng(SERVER_PATH.'uploads/'.$_SESSION['sidebar']);
			break;			
		case 'jpeg':
		case 'jpg':
		case 'pjpeg':
			$sideimage = imagecreatefromjpeg(SERVER_PATH.'uploads/'.$_SESSION['sidebar']);
			break;
		default:
			echo '<div style="padding:50px; color:#fff">Error, you cannot use this format, only Jpg, png and gif</div>';
			die;
	}
	$resizeside=@imagecreatetruecolor(150, 1050);
	$black = imagecolorallocate($resizeside, 0, 0, 0);
    imagecolortransparent($resizeside, $black);
    $src_width = imagesx($sideimage);
    $src_height = imagesy($sideimage); 
    imagecopyresampled($resizeside, $sideimage , 0, 0, 0, 0, 150, 1050, $src_width, $src_height);
    $im=$resizeside;
    $outputfi=SERVER_PATH."uploads/".time().rand(11,99).'.png';
    $nefile=time().rand(11,99).'.png';
    imagepng($im,$outputfi, 9);
    $cmd = " {$outputfi} -matte -virtual-pixel transparent -interpolate Spline -distort Perspective '0,0 0,35   300,0 300,25   300,350 300,351   0,900 0,850'  ".SERVER_PATH."uploads/".$nefile;
    exec("convert $cmd ");
    $dst = imagecreatefrompng(SERVER_PATH."uploads/".$nefile);
    $black = imagecolorallocate($dst, 0, 0, 0);
    imagecolortransparent($dst, $black);
    $im=$dst;
    // imagecopy ($backimage,$dst,580,150,0,0,$src_width,$src_height);
    // $im=$backimage;
}
?>