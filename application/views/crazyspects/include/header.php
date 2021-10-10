
<style>
     .navbar-nav li a{
      margin-top:10px;
     }
     .dropdown-toggle::after{
      display:none;
     }
     .nav-item a{
      font-size: 20px;
    line-height: 26px;
    color: #191919;
     }
     .navbar-light .navbar-nav .nav-link{
      color: #AEE518!important;
     }
     .user-name-responsive{
      font-size: 20px;
      color: #AEE518!important;
     }
     .active{
         border-bottom: 5px solid #AEE518!important;
     }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color:#323232!important">
  <div class="row" style="width: 100%;">
    <div class="col-lg-3 col-md-6 col-sm-6">
  <a class="navbar-brand" href="<?php echo base_url() ?>">
    <img style="width: 100%;height: 56px;" src="<?php echo base_url('img/thumb_logo') ?>"></a>
   </div>
   <div class="col-lg-6 col-md-3 col-sm-3">
  <div class="collapse navbar-collapse" id="navbarNav" style="float: left;">
    <ul class="navbar-nav">
      <li class="nav-item <?php echo $page=='home.php'?'active':'' ?> menu-item menu-item-1">
        <a class="nav-link" href="<?php echo base_url() ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php echo $page=='profile.php'?'active':'' ?>">
        <a class="nav-link" href="<?php echo base_url('home/profile') ?>">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('home/create_thumbnail') ?>">Thumbnail <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('home/create_thumbnail?ebook=1') ?>">Ebook <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('home/mock_up') ?>">Mock <span class="sr-only"></span></a>
      </li>
      <?php
      if($_SESSION['user']['is_admin']==1){
      ?>
      <li class="nav-item <?php echo $page=='users.php'?'active':'' ?>">
        <a class="nav-link" href="<?php echo base_url('home/manage_users') ?>">Manage Users <span class="sr-only"></span></a>
      </li>
      <?php } ?>
    </ul>
  </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-3" style="display: flex;">
    <?php if(isset($_SESSION['is_login'])){ ?>
      <ul style="float: right;display: flex;margin-left: auto; 
margin-right: 0;">
      <li class="user-name">
            <p class="user-name-responsive" style="margin-top: 24px;font-family: sans-serif;">
              Welcome
              <span><?php echo $_SESSION['user']['Name'] ?></span>
            </p>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img  style="margin-top:6px;" src="<?php echo $_SESSION['user']['profile']!=''?base_url('uploads/profile/'.$_SESSION['user']['profile']):base_url('plugins/images/users/genu.jpg') ?>" alt="profile-image" width="40" height="40" class="rounded-circle">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?php echo base_url('home/logout') ?>">Log Out</a>
        </div>
      </li>

       
      </ul> 
    <?php } ?>
    <button class="navbar-toggler" type="button" onclick="$('.navbar_mobile').toggle();$('.navbar_mobile .navbar-collapse').toggleClass('show');">
     <span class="navbar-toggler-icon"></span>
    </button>
  </div>
  <div class="navbar_mobile col-12" style="display:none;">
  <div class="collapse navbar-collapse" id="navbarNav" style="float: left;">
    <ul class="navbar-nav">
      <li class="nav-item menu-item menu-item-1">
        <a class="nav-link" href="<?php echo base_url() ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('home/profile') ?>">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('home/create_thumbnail') ?>">Thumbnail <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('home/create_thumbnail?ebook=1') ?>">Ebook <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('home/mock_up') ?>">Mock <span class="sr-only"></span></a>
      </li>
      <?php
      if($_SESSION['user']['is_admin']==1){
      ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('home/manage_users') ?>">Manage Users <span class="sr-only"></span></a>
      </li>
      <?php } ?>
    </ul>
  </div>
  </div>
</div>
</nav>