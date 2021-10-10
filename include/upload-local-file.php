<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$urlsubfolder = '';

#export
/*
this prefix will output an image named : mywebsite-filter-15454.jpg or mywebsite-filter-9454.gif
*/
$yourbrand = 'Your website';

#export
/*
this prefix will output an image named : mywebsite-filter-15454.jpg or mywebsite-filter-9454.gif
*/
$thumbprefix = 'mywebsite';

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
if(isset($_POST))
{

	if(!isset($_FILES['imagefile']) || !is_uploaded_file($_FILES['imagefile']['tmp_name']))
	{
			echo '<div style="padding:50px; color:#fff">Error, cannot use this filetype</div>';
			die; 
	}
	if(isset($_FILES['imagefileside']) && $_FILES['imagefileside']['name']!=""){
	    $filename=time().rand(11,99)."Sidebar".$_FILES['imagefileside']['name'];
	    move_uploaded_file($_FILES['imagefileside']['tmp_name'], $_SERVER["DOCUMENT_ROOT"].'/thumbnail_app/uploads/'.$filename);
	    $_SESSION['sidebar']=$filename;
	    $filename = $_FILES['imagefileside']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $_SESSION['ext']=$ext;
	}


	$imagefilename 		= str_replace(' ','-',strtolower($_FILES['imagefile']['name'])); 
	$imagetmp	 	= $_FILES['imagefile']['tmp_name']; 
	$imagefiletype	 	= $_FILES['imagefile']['type']; 


	switch(strtolower($imagefiletype))
	{
		case 'image/png':
			$CreatedImage =  imagecreatefrompng($_FILES['imagefile']['tmp_name']);
			break;
		case 'image/gif':
			$CreatedImage =  imagecreatefromgif($_FILES['imagefile']['tmp_name']);
			break;			
		case 'image/jpeg':
		case 'image/pjpeg':
			$CreatedImage = imagecreatefromjpeg($_FILES['imagefile']['tmp_name']);
			break;
		default:
			echo '<div style="padding:50px; color:#fff">Error, you cannot use this format, only Jpg, png and gif</div>';
			die;
	}
	
	list($originalwidth,$originalheight)=getimagesize($imagetmp);	
	$extension=pathinfo($imagefilename, PATHINFO_EXTENSION);
	$random = rand(0, 9999999999); 
	$name = $random.'.'.$extension;
	$savefile = '../'.$outputdirectory.'/'.$name;
	
	
	if(resizeImage($originalwidth,$originalheight,$imagesize,$savefile,$CreatedImage,$imagequality,$imagefiletype))
	{
		echo '<div class="shadow"><img id="res" src="'.$outputdirectory.'/'.$name.'" style="display:none"></div>';
		?>
		<script>
		var imagename ='<?php echo $name; ?>';
		</script>
		<?php
	}
	else
	{
		die('Error'); 
	}
}



function resizeImage($originalwidth,$originalheight,$maximumsize,$DestFolder,$baseimage,$imagequality,$imagefiletype)
{

	if($originalwidth <= 0 || $originalheight <= 0) 
	{
		return false;
	}
	
	$generalscale = min($maximumsize/$originalwidth, $maximumsize/$originalheight); 
	$modwidth = ceil($generalscale*$originalwidth);
	$modheight = ceil($generalscale*$originalheight);
	$finalimage = imagecreatetruecolor($modwidth, $modheight);
	
	if(imagecopyresampled($finalimage, $baseimage,0, 0, 0, 0, $modwidth, $modheight, $originalwidth, $originalheight))
	{
		switch(strtolower($imagefiletype))
		{
			case 'image/png':
				imagepng($finalimage,$DestFolder);
				break;
			case 'image/gif':
				imagegif($finalimage,$DestFolder);
				break;			
			case 'image/jpeg':
			case 'image/pjpeg':
				imagejpeg($finalimage,$DestFolder,$imagequality);
				break;
			default:
				return false;
		}

	if(is_resource($finalimage)) {imagedestroy($finalimage);} 
	return true;
	}

}
