<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="<?php echo base_url('img/iconh.png') ?>" type="image/gif" >
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
    <meta name="theme-color" content="#000000" />
    <link rel="shortcut icon" href="/favicon.ico" />
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
   <script src="<?php echo base_url() ?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/auth.css') ?>">
    <style>
    body {
        margin: 0;
        padding: 0
    }
    #root {
        width: 100vw;
        height: 100vh
    }
    body {
  background: #f7f7f7;
}
.profile-thumb-block img{
  width:100%;
}
 
 .profile-card-3 {
  font-family: 'Open Sans', Arial, sans-serif;
  position: relative;
  float: left;
  overflow: hidden;
  width: 100%;
  text-align: center;
  height:368px;
  border:none;
}
.profile-card-3 .background-block {
    float: left;
    width: 100%;
    height: 200px;
    overflow: hidden;
}
.profile-card-3 .background-block .background {
  width:100%;
  vertical-align: top;
  opacity: 0.9;
  -webkit-filter: blur(0.5px);
  filter: blur(0.5px);
   -webkit-transform: scale(1.8);
  transform: scale(2.8);
}
.profile-card-3 .card-content {
  width: 100%;
  padding: 15px 25px;
  color:#232323;
  float:left;
  background:#323232!important;
  height:50%;
  border-radius:0 0 5px 5px;
  position: relative;
  z-index: 9999;
}
.profile-card-3 .card-content::before {
    content: '';
    background: #323232!important;
    width: 120%;
    height: 100%;
    left: 11px;
    bottom: 51px;
    position: absolute;
    z-index: -1;
    transform: rotate(-13deg);
}
.profile-card-3 .profile {
  border-radius: 50%;
  position: absolute;
  bottom: 50%;
  left: 50%;
  max-width: 100px;
  opacity: 1;
  box-shadow: 3px 3px 20px rgba(0, 0, 0, 0.5);
  border: 2px solid rgba(255, 255, 255, 1);
  -webkit-transform: translate(-50%, 0%);
  transform: translate(-50%, 0%);
  z-index:99999;
}
.profile-card-3 h2 {
  margin: 0 0 5px;
  font-weight: 600;
  font-size:25px;
}
.profile-card-3 h2 small {
  display: block;
  font-size: 15px;
  margin-top:10px;
}
.profile-card-3 i {
  display: inline-block;
    font-size: 16px;
    color: #232323;
    text-align: center;
    border: 1px solid #232323;
    width: 30px;
    height: 30px;
    line-height: 30px;
    border-radius: 50%;
    margin:0 5px;
}
.profile-card-3 .icon-block{
    float:left;
    width:100%;
    margin-top:15px;
}
.profile-card-3 .icon-block a{
    text-decoration:none;
}
.profile-card-3 i:hover {
  background-color:#232323;
  color:#fff;
  text-decoration:none;
}
.container-fluid{
  margin-top:30px;
} 
div .title-area h2{
    font-family: 'Poppins';
    font-weight: 700;
    color: #AEE518;
    font-size: 30px;
    line-height: 40px;
}  
.card{
    background-color:#323232!important;
}
</style>
    <title><?php echo $title ?></title>
</head>

<body>
   <?php include('include/header.php') ?>
    <div id="root">
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
         <div class="title-area">
            <h2>Profile</h2>
          </div>
    </div>
    <div class="col-lg-4 col-xlg-3 col-md-12">
            <div class="card profile-card-3">
                <div class="background-block">
                    <img src="https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" alt="profile-sample1" class="background"/>
                </div>
                <div class="profile-thumb-block">
                    <img src="<?php echo $_SESSION['user']['profile']!=''?base_url('uploads/profile/'.$_SESSION['user']['profile']):base_url('plugins/images/users/genu.jpg') ?>" alt="profile-image" class="profile"/>
                </div>
                <div class="card-content">
                    <h2><?php echo $_SESSION['user']['Name'] ?></small></h3>
                    </div>
                </div>
                <!-- <p class="mt-3 w-100 float-left text-center"><strong>Modren Profile Card</strong></p> -->
        </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" id="register-form" onsubmit="return submit_form()">
                                  <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input style="padding: 8px!important" type="text" value="<?php echo $_SESSION['user']['Name']?>" placeholder="johnathan@admin.com"
                                                class="form-control p-0 border-0" name="name"
                                                id="example-email">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input style="padding: 8px!important" type="email" value="<?php echo $_SESSION['user']['emailId']?>" placeholder="johnathan@admin.com"
                                                class="form-control p-0 border-0" name="email"
                                                id="example-email">
                                        </div>
                                    </div>
                                    <input type="hidden" name="mobile" value="<?php echo $_SESSION['user']['mobileNumber']?>" placeholder="123 456 7890"
                                                class="form-control p-0 border-0">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Profile Pic</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input style="padding: 8px!important" type="file" name="image" 
                                                class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" id="from-error">
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12 unique-button">
                                            <button class="btn btn-success">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
</div>
</div>
</div>



<script>
  function submit_form(){
    $('.unique-button').html('<button type="button" class="btn btn-success"><i class="fas fa-spinner fa-pulse"></i></button>');
          var form=jQuery("#register-form")[0];
        var formdata1=new FormData(form);
     //   jQuery(form).trigger("reset");
        jQuery.ajax({
       url:'<?php echo base_url('home/update_profile') ?>',
       type:'post',
       data:formdata1,
       contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
       processData: false,
     success:function(result){
      $('.unique-button').html('<button class="btn btn-success">Update Profile</button>');
      var obj=JSON.parse(result);
      if(obj.status==1){
          jQuery(form).trigger("reset");
          $('#from-error').html('<p style="color:green">'+obj.err+'</p>');
          setTimeout(function() { 
              window.location.href=''}, 2000);
      }else{
         $('#from-error').html('<p style="color:red">'+obj.err+'</p>'); 
      }
     }
     }); 
    return false;
  }
</script>
</body>

</html>