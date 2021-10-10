<?php
include ('include/config.php');
if(!isset($_GET['type'])){
    $_GET['type']="";
}
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/auth.css') ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

<link href="<?php echo base_url() ?>css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.form.js"></script>

<style>
.filter{
    width:25%;
}
.help{
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
}
h3 a{
    color:#AEE518!important;
}
#wrapper{
    padding-top: 16px;
}
.bs-wizard {margin-top: 40px;}

/*Form Wizard*/
.bs-wizard {border-bottom: solid 1px #e0e0e0; padding: 0 0 10px 0;}
.bs-wizard > .bs-wizard-step {padding: 0; position: relative;}
.bs-wizard > .bs-wizard-step + .bs-wizard-step {}
.bs-wizard > .bs-wizard-step .bs-wizard-stepnum {color: #AEE518; font-size: 16px; margin-bottom: 5px;}
.bs-wizard > .bs-wizard-step .bs-wizard-info {color:  #fff; font-size: 14px;}
.bs-wizard > .bs-wizard-step > .bs-wizard-dot {position: absolute; width: 30px; height: 30px; display: block; background: #fbe8aa; top: 45px; left: 50%; margin-top: -15px; margin-left: -15px; border-radius: 50%;} 
.bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {content: ' '; width: 14px; height: 14px; background: #fbbd19; border-radius: 50px; position: absolute; top: 8px; left: 8px; } 
.bs-wizard > .bs-wizard-step > .progress {position: relative; border-radius: 0px; height: 8px; box-shadow: none; margin: 20px 0;}
.bs-wizard > .bs-wizard-step > .progress > .progress-bar {width:0px; box-shadow: none; background: #fbe8aa;}
.bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {width:100%;}
.bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {width:50%;}
.bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {width:0%;}
.bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {width: 100%;}
.bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {background-color: #f5f5f5;}
.bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {opacity: 0;}
.bs-wizard > .bs-wizard-step:first-child  > .progress {left: 50%; width: 50%;}
.bs-wizard > .bs-wizard-step:last-child  > .progress {width: 50%;}
.bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot{ pointer-events: none; }
</style>



</head>

<body>
<?php include('include/header.php') ?>

<div class="contentholder">


 <!-- NEED TO ADD LINK FOR BILLBOARD -->
<div class="top" hidden>
	<!--		<h1 style="color:#333">Mockups Land</h1>    -->
	
	<h1> <a href="http://www.mockupsland.com/home/">  <img src="assets/images/logo1.png"> </a> </h1>
	
	
<div class="photomenu"><a href="index.php?type=photo-montage" class="photomontage">Photo</a> 
<a href="index.php?type=special-effects"  class="specialeffects">Effects</a>
<a href="index.php?type=billboard" class="specialeffects">Billboards</a>
</div>
</div> 





<div class="help">
  <h2>Please select a template</h2>
</div>
<div class="container">
		
        
            <div class="row bs-wizard" style="border-bottom:0;">
                
                <div class="col-4 bs-wizard-step active">
                  <div class="text-center bs-wizard-stepnum">Step 1</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Choose a 3D Mockup</div>
                </div>
                
                <div class="col-4 bs-wizard-step"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Step 2</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Select Your Cover Image</div>
                </div>
                
                <div class="col-4 bs-wizard-step"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Step 3</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Download Your Free Mockup</div>
                </div>
                
            </div>
        
        
        
        
        
	</div>
</div>
<div id="wrapper" class="row">

<?php

if($_GET['type']=='photo-montage') {
foreach (glob("include/filters/collage/*.php") as $filename)

{
$cleanfile = str_replace("include/filters/collage/", "", $filename);
$id = str_replace(".php", "", $cleanfile);
echo '<div class="col-4 col-xm-6"><a href="filter.php?cat=collage&id='.$id.'"><img src="include/filters/collage/'.$id.'.jpg" width="220"></a><h3><a href="filter.php?cat=collage&id='.$id.'">'.$id.' photo collage</a></h3></div>';
}

}

elseif ($_GET['type']=='special-effects') {
foreach (glob("include/filters/effects/*.php") as $filename)

{
$cleanfile = str_replace("include/filters/effects/", "", $filename);
$id = str_replace(".php", "", $cleanfile);
echo '<div class="filter"><a href="filter.php?cat=effects&id='.$id.'"><img src="include/filters/effects/'.$id.'.jpg" width="220"></a><h3><a href="filter.php?cat=effects&id='.$id.'">'.$id.' photo effect</a></h3></div>';
}

}
/* DODANO ZA BILLBOARD*/

elseif ($_GET['type']=='billboard') {
foreach (glob("include/filters/billboard/*.php") as $filename)

{
$cleanfile = str_replace("include/filters/billboard/", "", $filename);
$id = str_replace(".php", "", $cleanfile);
echo '<div class="filter"><a href="filter.php?cat=billboard&id='.$id.'"><img src="include/filters/billboard/'.$id.'.jpg" width="220"></a><h3><a href="filter.php?cat=billboard&id='.$id.'">'.$id.' photo billboard</a></h3></div>';
}

}


else {
foreach (glob("include/filters/collage/*.php") as $filename)
{
$cleanfile = str_replace("include/filters/collage/", "", $filename);
$id = str_replace(".php", "", $cleanfile);
echo '<div class="col-4"><a href="'.base_url('home/filter?cat=collage&id='.$id.'').'"><img src="'.base_url().'include/filters/collage/green-template/'.$id.'.jpg" width="220"></a><h3 style="text-align: center;"><a href="'.base_url('home/filter?cat=collage&id='.$id.'').'">'.$id.'</a></h3></div>';
}

// foreach (glob("include/filters/effects/*.php") as $filename)
// {
// $cleanfile = str_replace("include/filters/effects/", "", $filename);
// $id = str_replace(".php", "", $cleanfile);
// echo '<div class="filter"><a href="filter.php?cat=effects&id='.$id.'"><img src="include/filters/effects/'.$id.'.jpg" width="220"></a><h3><a href="filter.php?cat=effects&id='.$id.'">'.$id.' photo effect</a></h3></div>';
// }

// /* TAKOĐER DODANO ZA BILLBOARD */
// foreach (glob("include/filters/billboard/*.php") as $filename)
// {
// $cleanfile = str_replace("include/filters/billboard/", "", $filename);
// $id = str_replace(".php", "", $cleanfile);
// echo '<div class="filter"><a href="filter.php?cat=billboard&id='.$id.'"><img src="include/filters/billboard/'.$id.'.jpg" width="220"></a><h3><a href="filter.php?cat=billboard&id='.$id.'">'.$id.' photo effect</a></h3></div>';
// }

}

?>

</div>


<div class="ad" hidden>
   <img src="assets/images/ad.gif"  width="768" height="90" alt="ad" />
</div>
	

<p class="p111" hidden>
	<a href="https://www.facebook.com/mockups.crazy/" target="_blank"><img src="assets/images/facebook1.png"></a>
	<a href="https://www.twitter.com/mockupsland" target="_blank"><img src="assets/images/twitter1.png"></a>
	<a href="https://www.plus.google.com/u/2/101387435340590293890" target="_blank"><img src="assets/images/googleplus1.png"></a>
</p>









</div>






</body>

</html>









