<?php
include ('include/config.php');
$category = $_GET['cat'];
$filter = $_GET['id'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/auth.css') ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

<link href="<?php echo base_url() ?>css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.form.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<style>
#wrapper{
  text-align: center;
  padding-top: 16px;
}
#imageuploadform{
    margin-top: 19px;
    margin-left: 74px;
}
.help{
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
}
h3 a{
    color:#AEE518!important;
}
#res{
    width:60%;
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
.input-group{
    width: 50%;
    margin-left: 25%;
}
.uploaded img{
    width:50%;
}
.custom-file-label{
    text-align:left;
}
</style>

<script>
$(document).ready(function() { 
var upload_bool;
//form process

$('#imageuploadform').on('submit', function(event) {
    event.preventDefault();
    <?php if($filter=='box'){ ?>
    var sidefile = $('#imagefileside')[0].files[0];
	if(!sidefile){
swal("Please Select Side Image.")
.then((value) => {
  window.location.href='';
});
	    return
	}
	<?php } ?>
	$("#message").css("display", "none");
	$("#output").html('<div style="padding:50px"><img src="<?php echo base_url() ?>img/ajax-loader.gif" class="loader"/></div>');
	$("#file").removeClass('uploadinput').addClass('uploadinputnext');
	$("#imageuploadform").css("margin-top", "0px");
	var file = $('#file')[0].files[0]
	
    if (file){
     $('.labeltext').text(file.name);
     
   }

		//then we get the server response and hide the loading animation

		$(this).ajaxSubmit({
		target: '#output',
			success: function() {
			    $('#final-head-text').text("Download Your Free Mockup");
				$(".loader").css("display", "none");
				$(".shadow").css("display", "none"); 
				$(".shadow").load("<?php echo base_url() ?>include/script.php?fx=<?php echo $filter; ?>&imagename="+imagename+"&type=<?php echo $category; ?>");
				$('.shadow').fadeIn('slow').show("slow");
				$('.upload-ok').css("display", "block");
				$('.upload-nok').css("display", "none");
				$('.uploaded').html('<img src="<?php echo base_url().$outputdirectory; ?>/'+imagename+'" width="50">');
				$('#form-final-wizard-0').removeClass('active').addClass('complete');
				$('#form-final-wizard').addClass('complete');
				
			}
		});
});

//onchange submits the file	
	
$("#file").change(function () {
	$('#imageuploadform').submit();
});


$(".filter").click(function () {
				var data_cat = $(this).data('cat');
				var data_idfilter = $(this).data('idfilter');
				$(".loader").css("display", "none");
				$(".shadow").css("display", "none"); 
				$(".shadow").load("include/script.php?fx="+data_idfilter+"&imagename="+imagename+"&type="+data_cat+"");
				$('.shadow').fadeIn('slow').show("slow");
				$('.help').hide('slow');
				var body = $("html, body");
				body.animate({scrollTop:0}, '500', 'swing', function() { 
				});
				});




}); 
</script>

</head>

<body>
<?php include('include/header.php') ?>
<div class="contentholder">
<div class="help">
  <h2 id="final-head-text">Select Your Cover Image</h2>
</div>
<div class="container">
		
        
            <div class="row bs-wizard" style="border-bottom:0;">
                
                <div class="col-4 bs-wizard-step complete">
                  <div class="text-center bs-wizard-stepnum">Step 1</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Choose a 3D Mockup</div>
                </div>
                
                <div class="col-4 bs-wizard-step active" id="form-final-wizard-0"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Step 2</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Select Your Cover Image</div>
                </div>
                
                <div class="col-4 bs-wizard-step" id="form-final-wizard"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Step 3</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Download Your Free Mockup</div>
                </div>
                
            </div>
        
        
        
        
        
	</div>
</div>

<div id="wrapper">

<div id="message">

</div>

<form action="<?php echo base_url() ?>include/upload-local-file.php" method="post" enctype="multipart/form-data" id="imageuploadform">
	<div class="uploaded" style="display:inline-block"></div>
	<?php if($filter=='box'){ ?>
	   <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01 uploadinput">Upload</span>
  </div>
  <div class="custom-file">
    <input type="file" accept="image/png, image/jpg, image/jpeg" name="imagefileside" onchange ="var file=$('#imagefileside')[0].files[0];$('.labeltext12').text(file.name); " class="custom-file-input" id="imagefileside"
      aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label labeltext12" for="inputGroupFile01">Choose Side File</label>
  </div>
</div>
	<?php echo "</br>"; } ?>
	<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01 uploadinput">Upload</span>
  </div>
  <div class="custom-file">
    <input type="file" accept="image/png, image/jpg, image/jpeg" name="imagefile" class="custom-file-input" id="file"
      aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label labeltext" for="inputGroupFile01">Choose file</label>
  </div>
</div>
</form>





<!--picture holder start-->
<div id="output"><img src="<?php echo base_url() ?>include/filters/<?php echo $category; ?>/green-template/<?php echo $filter; ?>.jpg" style="margin-bottom:5px;width: 50%;"></div>
<!--picture holder end-->








</div>
</body>

</html>









