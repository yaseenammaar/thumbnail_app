<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/thumbnail_app/');
function base_url(){
    return 'http://18.185.104.72/thumbnail_app/';
}
include (SERVER_PATH.'application/views/crazyspects/include/config.php');
$urlsubfolder = 'http://photofun.websarthe.com/testsubfolder/';

#export
/*
this prefix will output an image named : mywebsite-filter-15454.jpg or mywebsite-filter-9454.gif
*/
$yourbrand = 'Your website';

#export
/*
this prefix will output an image named : mywebsite-filter-15454.jpg or mywebsite-filter-9454.gif
*/
$thumbprefix = 'mockup';

#twitter sharing text
/*
when sharing on twitter, you enter both a url & a text, by default the text is the name of the website but you can change it to whatever you want
*/
$twittertext = 'mywebsite';


#upload 
/*
outputdirectory is the folder where the images are uploaded and imagequality is the quality used when one uploads a jpg file.
*/ 
$outputdirectory = 'uploads'; 
$imagequality = 100;

/*
Image size is the maximum width or height of the resized image when uploaded but we advise you not to change this value unless your server can handle large images.
*/
$imagesize = 900;
if (!isset($_GET['fx'])) { 
die("fx");
} 
else 
{ 
$fx = htmlspecialchars($_GET['fx'], ENT_QUOTES); 
}

if (!isset($_GET['imagename'])) 
{ 
die("name");
} 
else 
{ 
$url = base_url().'uploads/'.$_GET['imagename'];
}




$cleanname = htmlspecialchars($_GET['imagename'], ENT_QUOTES);
$outputfile = $thumbprefix.'-'.$fx.'-'.'.png';

$firstlayer = rand(546,8784).'a'.rand(9788,68464);
$secondlayer = rand(546,8784).'b'.rand(9788,68464);
$output = rand(546,8784).'c'.rand(9788,68464);

$type = getimagesize($url);
switch($type['mime'])
	{
		case 'image/png':
			$src_img = imagecreatefrompng($url);
			include('filters/'.$_GET['type'].'/'.$fx.'.php');
		/*watermark*/
			/*$stamp = imagecreatefrompng('../img/watermark.png');			
			$marge_right = 10;
			$marge_bottom = 10;
			$sx = imagesx($stamp);
			$sy = imagesy($stamp);
			imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
		    */
		/*watermark*/
			imagepng($im, SERVER_PATH.'/uploads/output/'.$outputfile.'');
imagedestroy($im);
			echo '<div class="shadow"><img id="res" src="'.base_url().'/uploads/output/'.$outputfile.'?'.rand(1,3000).'"></div>';
			echo '<div class="save"><a href="'.base_url().'/uploads/output/'.$outputfile.'?'.rand(1,3000).'" download><img src="'.base_url().'img/save.png"></a></div>';
			$imgurl = $urlsubfolder.'output/'.$outputfile.'';
//echo '<div class="socialholder"><div class="social"><a href="http://www.facebook.com/sharer.php?u='.$imgurl.'"  target="_blank" class="social-button" style="background:#495fbd;">
//<img src="img/facebook.gif" alt="Share on Facebook"></a></div><div class="social"><a href="http://twitter.com/share?url='.$imgurl.'&text='.$twittertext.'"  target="_blank" class="social-button" style="background:#495fbd;"><img src="img/twitter.gif" alt="Share on Twitter"></a></div><div class="social"><a href="https://plus.google.com/share?url='.$imgurl.'" class="social-button"  target="_blank" style="background:#495fbd;"><img src="img/google.gif" alt="Share on Google+1"></a></div></div>';
			break;
			
			
			
		case 'image/gif':
			$src_img = imagecreatefromgif($url);
			include('filters/'.$_GET['type'].'/'.$fx.'.php');
			/*watermark*/
			/*$stamp = imagecreatefrompng('../img/watermark.png');			
			$marge_right = 10;
			$marge_bottom = 10;
			$sx = imagesx($stamp);
			$sy = imagesy($stamp);
			imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
			*/
			/*watermark*/
			imagegif($im, '../output/'.$outputfile.'');
imagedestroy($im);
			echo '<div class="shadow"><img id="res" src="'.base_url().'/uploads/output/'.$outputfile.'?'.rand(1,3000).'"></div>';
			echo '<div class="save"><a href="'.base_url().'/uploads/output/'.$outputfile.'?'.rand(1,3000).'" download><img src="'.base_url().'img/save.png"></a></div>';
			$imgurl = $urlsubfolder.'output/'.$outputfile.'';
//echo '<div class="socialholder"><div class="social"><a href="http://www.facebook.com/sharer.php?u='.$imgurl.'"  target="_blank" class="social-button" style="background:#495fbd;">
//<img src="img/facebook.gif" alt="Share on Facebook"></a></div><div class="social"><a href="http://twitter.com/share?url='.$imgurl.'&text='.$twittertext.'"  target="_blank" class="social-button" style="background:#495fbd;"><img src="img/twitter.gif" alt="Share on Twitter"></a></div><div class="social"><a href="https://plus.google.com/share?url='.$imgurl.'" class="social-button"  target="_blank" style="background:#495fbd;"><img src="img/google.gif" alt="Share on Google+1"></a></div></div>';
			break;		




			
		case 'image/jpeg':
		case 'image/pjpeg':
		$src_img = imagecreatefromjpeg($url);	
		include('filters/'.$_GET['type'].'/'.$fx.'.php');
		/*watermark*/
			/*$stamp = imagecreatefrompng('../img/watermark.png');			
			$marge_right = 10;
			$marge_bottom = 10;
			$sx = imagesx($stamp);
			$sy = imagesy($stamp);
			imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
		   */
		/*watermark*/
// 		imagecreatefromjpeg($im, '../uploads/output/'.$outputfile.'', $imagequality);
		imagepng($im, '../uploads/output/'.$outputfile.'', 9);
		imagedestroy($im);		
			echo '<div class="shadow"><img id="res" src="'.base_url().'/uploads/output/'.$outputfile.'?'.rand(1,3000).'"></div>';
			echo '<div class="save"><a href="'.base_url().'/uploads/output/'.$outputfile.'?'.rand(1,3000).'" download><img src="'.base_url().'img/save.png"></a></div>';
$imgurl = $urlsubfolder.'output/'.$outputfile.'';
//echo '<div class="socialholder"><div class="social"><a href="http://www.facebook.com/sharer.php?u='.$imgurl.'"  target="_blank" class="social-button" style="background:#495fbd;">
//<img src="img/facebook.gif" alt="Share on Facebook"></a></div><div class="social"><a href="http://twitter.com/share?url='.$imgurl.'&text='.$twittertext.'"  target="_blank" class="social-button" style="background:#495fbd;"><img src="img/twitter.gif" alt="Share on Twitter"></a></div><div class="social"><a href="https://plus.google.com/share?url='.$imgurl.'" class="social-button"  target="_blank" style="background:#495fbd;"><img src="img/google.gif" alt="Share on Google+1"></a></div></div>';
			break;
		default:
		echo '<div style="padding:50px">Error, cannot use this filetype</div>';
			die;
	}
?>