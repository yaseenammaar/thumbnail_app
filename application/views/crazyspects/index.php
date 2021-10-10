<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
    <meta name="theme-color" content="#000000" />
    <link rel="icon" href="<?php echo base_url('img/iconh.png') ?>" type="image/gif" >
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
    width: 78px;
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
 

#dashboard-table_wrapper{
    width:100%;
}
.dataTables_filter label{
    display:none;
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
            <h2>Your Work</h2> </div>
        </div>
        <div class="col-xs-12 table-responsive">
          <div id="dashboard-table_wrapper" class="dataTables_wrapper form-inline no-footer">
            <table id="dashboard-table" class="table table-hover table-condensed dataTable no-footer" role="grid" aria-describedby="dashboard-table_info">
              <thead>
                <tr role="row">
                  <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                    Thumbnail
                  " style="width: 132.328px;">
                    <h6>Thumbnail</h6> </th>
                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                    Kind
                  " style="width: 132.328px;">
                    <h6>Kind</h6> </th>
                  <th class="sorting_desc" tabindex="0" aria-controls="dashboard-table" rowspan="1" colspan="1" aria-sort="descending" aria-label="
                    Created
                  : activate to sort column ascending" style="width: 168.641px;">
                    <h6>Created</h6> </th>
                    <?php if($_SESSION['user']['is_admin']==1){ ?>
                    <th class="sorting_desc" tabindex="0" aria-controls="dashboard-table" rowspan="1" colspan="1" aria-sort="descending" aria-label="
                    Created
                  : activate to sort column ascending" style="width: 168.641px;">
                    <h6>Is Free</h6> </th>
                    <?php } ?>
                  <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                    Actions
                  " style="width: 187.438px;">
                    <h6>Actions</h6> </th>
                    
                </tr>
              </thead>
              <tbody>
                <?php if(count($thumbnails)>0){
                  foreach($thumbnails as $key=>$thumb){
                if($thumb['thumbnail']==""){
                    continue;
                }?>
                <tr role="row" class="odd">
                  <td>
                    <a href="<?php echo base_url('uploads/thumbnails/'.$thumb['thumbnail']) ?>" target="_blank"> 
                      <img src="<?php echo base_url('uploads/thumbnails/'.$thumb['thumbnail']) ?>" class="thumb-list" style="height:180px;width:<?php echo $thumb['pdf']==""?'320':'120' ?>px;"> 
                    </a>
                  </td>
                  <td >
                   <div style="display:flex;margin-top:62px">
                    <?php echo $thumb['pdf']==""?'Thumbnail':'Ebook :&nbsp;<a href="'.base_url('uploads/thumbnails/'.$thumb['pdf']).'" target="_blank">View</a>' ?>
                    </div>
                  </td>
                  <td class="sorting_1">
                  <div style="display:flex;margin-top:62px">
                    <p><?php echo date("d M Y",$thumb['time']) ?></p>
                    </div>
                  </td>
                  <?php if($_SESSION['user']['is_admin']==1){ ?>
                  <td class="sorting_1">
                  <div style="display:flex;margin-top:62px">
                    <p><?php echo $thumb['is_paid']==1?'No':'Yes' ?></p>,
                    <a  href="<?php echo base_url('home/change_template_type/'.$thumb['id']) ?>">Change</a>
                    </div>
                  </td>
                  <?php } ?>
                  <td >
                  <div style="display:flex;margin-top:25%">
                   <a style="border-radius: 20px;margin-right:10px;color: black;" class="btn btn-danger" href="<?php echo base_url('home/delete_thumbnail/'.$thumb['id']) ?>"><i class="far fa-trash-alt"></i> Delete</a>
                   <a class="btn btn-danger" style="color: black;border-radius: 20px;background-color: #AEE518;border-color: #AEE518;" href="<?php echo $thumb['pdf']==""?base_url('uploads/thumbnails/'.$thumb['thumbnail']):base_url('uploads/thumbnails/'.$thumb['pdf']) ?>" download><i class="fas fa-download"></i> Download</a>
                   </div>
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
    "ordering": false,

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