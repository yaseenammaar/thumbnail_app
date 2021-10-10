<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
    <meta name="theme-color" content="#000000" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="icon" href="<?php echo base_url() ?>img/iconh.png" type="image/gif" >
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/auth.css') ?>">
   <script src="<?php echo base_url() ?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
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
/*#root .container{
    margin-top:30px;
}*/
#example_wrapper{
    padding:30px;
}
.container-fluid{
    border-radius: 15px;
    background-color:#fff;
}
/*.mb-5, .my-5 {
    margin-bottom: 3rem!important;
}*/
div .title-area h2{
    font-family: 'Poppins';
    font-weight: 700;
    color: #451e61;
    font-size: 30px;
    line-height: 40px;
}
.rowcol{
    padding: 30px;
}
label{
    font-family: 'Poppins';
    font-weight: 600!important;
}
th {
    font-family: 'Poppins'!important;
    font-weight: 600!important;
    font-size: 18px!important;
}
.thumb-list {
    height: 46px;
    width: 46px;
    margin-left: 2px;
    border: 2px #c7c1cc solid;
    border-radius: 5px;
}
.dataTables_length{
      float: left;
    width: 50%;
}
.dataTables_length label{
  float: left;
}
.dataTables_filter label{
  float:right;
  padding-bottom:10px;
}

    </style>
    <title><?php echo $title ?></title>
</head>

<body>
   <?php include('include/header.php') ?>
<main id="main-content" class="main-content-area">
  <section id="dashboard-sec-1" class="data-section">
    <div class="site-container">
      <div class="row-3 data-table" id="thumbnail-div">
        <div class="col col-xs-12">
          <div class="title-area mb-5">
            <h2>Manage Users</h2> </div>
        </div>
        <div class="col-xs-12 table-responsive">
          <div id="dashboard-table_wrapper" class="dataTables_wrapper form-inline no-footer">
            <table id="dashboard-table" class="table table-hover table-condensed dataTable no-footer" role="grid" aria-describedby="dashboard-table_info">
              <thead>
                <tr role="row">
                  <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                    Name
                  " style="width: 310.078px;">
                    <h6>Name</h6> </th>
                  <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                    Thumbnail
                  " style="width: 132.328px;">
                    <h6>Profile</h6> </th>
                  <th class="sorting_desc" tabindex="0" aria-controls="dashboard-table" rowspan="1" colspan="1" aria-sort="descending" aria-label="
                    Created
                  : activate to sort column ascending" style="width: 168.641px;">
                    <h6>Email</h6> </th>
                    <?php if($_SESSION['user']['is_admin']==1){ ?>
                    <th class="sorting_desc" tabindex="0" aria-controls="dashboard-table" rowspan="1" colspan="1" aria-sort="descending" aria-label="
                    Created
                  : activate to sort column ascending" style="width: 168.641px;">
                    <h6>Is Pro</h6> </th>
                    <?php } ?>
                  <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                    Actions
                  " style="width: 187.438px;">
                    <h6>Actions</h6> </th>
                    
                </tr>
              </thead>
              <tbody>
                <?php 
                $thumbnails=$this->db->where('is_admin',0)->order_by('id', 'desc')->get('tblusers')->result_array();
                if(count($thumbnails)>0){
                  foreach($thumbnails as $key=>$thumb){ ?>
                <tr role="row" class="odd">
                  <td><?php echo $thumb['Name'] ?></td>
                  <td>
                    <a href="<?php echo $thumb['profile']!=''?base_url('uploads/profile/'.$thumb['profile']):base_url('plugins/images/users/genu.jpg') ?>" target="_blank"> 
                    <img src="<?php echo $thumb['profile']!=''?base_url('uploads/profile/'.$thumb['profile']):base_url('plugins/images/users/genu.jpg') ?>" class="thumb-list"> </a>
                  </td>
                  <td class="sorting_1">
                    <p><?php echo $thumb['emailId']?></p>
                  </td>
                  <?php if($_SESSION['user']['is_admin']==1){ ?>
                  <td class="sorting_1" style="display:flex">
                    <p><?php echo $thumb['is_pro']==0?'No':'Yes' ?></p>,
                    <a href="<?php echo base_url('home/change_user_status/'.$thumb['id']) ?>">Change</a>
                  </td>
                  <?php } ?>
                  <td>
                   <a href="<?php echo base_url('home/change_block_status/'.$thumb['id']) ?>"><?php echo $thumb['is_bann']==1?'Un Block':'Block' ?></a>
                   
                  </td>
                </tr>
              <?php }} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>



<script>
    $(document).ready(function() {
  $("#dashboard-table").DataTable({
    aaSorting: [],
    responsive: true,

    columnDefs: [
      {
        responsivePriority: 1,
        targets: 0
      },
      {
        responsivePriority: 2,
        targets: -1
      }
    ]
  });

  $(".dataTables_filter input")
    .attr("placeholder", "Search here...")
    .css({
      width: "300px",
      display: "inline-block"
    });

  $('[data-toggle="tooltip"]').tooltip();
});

    </script>
</body>

</html>