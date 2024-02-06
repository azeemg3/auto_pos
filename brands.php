<?php 
require_once'inc.func.php';
$cm->get_header("");
?>
<style type="text/css">
  
  .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 30px;
    user-select: none;
    -webkit-user-select: none;
    border-radius: 0px;
}
</style>
<script>
document.title='Transaction A/C';
</script>
<body onLoad="call_ajax('ajax_call/brand_action','', 'get_brands')">
  <!--============Modal add new barnds================-->
  <div class="modal fade" id="brand" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onClick="reset_form('form')">&times;</button>
          <h4 class="modal-title">Add New Brand</h4>
        </div>
        <!--success-Loader-->
        <div class="alert alert-success alert-dismissable col-md-8 col-md-offset-2" id="succ" style="display:none">
          <h4><i class="icon fa fa-check"></i> Alert!</h4>
             Operation Successfully!
        </div>
        <!--end-Loader-->
        <!--success-Loader-->
        <div class="alert alert-danger alert-dismissable col-md-8 col-md-offset-2" id="error" style="display:none">
          <h4><i class="icon fa fa-check"></i> Alert!</h4>
             Something Wrong With Your Query!
        </div>
        <!--end-Loader-->
        <form id="form">
          <input type="hidden" name="brand_id" value="0">
        <div class="modal-body">
          <div class="col-md-10">
            <div class="form-group">
              <label>Brand Name</label>
              <input type="text" name="brand_name" class="form-control input-sm" placeholder="Brand Name">
            </div>
          </div>
          <!--col-md-10-->
          <div class="col-md-2">
            <div class="form-group">
              <label style="visibility: hidden;">Test</label>
              <div class="clearfix"></div>
               <button type="button" class="btn btn-sm btn-success" onClick="add_new_brands()">Add</button>
            </div>
          </div>
        </div>
      </form>
        <div class="clearfix"></div>
        <div class="modal-footer">
          
        </div>
      </div>
      
    </div>
  </div>
  <!--===========End=Modal add new barnds================-->
<div class="content-wrapper" id="loadpage">
<section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
    <section class="content">
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">
  All Brands 
  </span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <form>
    <div class="col-md-2 pull-right">
      <div class="form-group">
        <button type="button" class="btn btn-sm btn-primary" onClick="openModal('brand')">Add New</button>
      </div>
    </div>
   </form>
   <div class="clearfix"></div>
   <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
      	<th width="10%">#</th>
        <th>Brand Name</th>
        <th width="10%">Action</th>
      </tr>
    </thead>
    <tbody class="get_brands"></tbody>
    </table>
  </div>
</div>
<!--panel panel-default-->

	</div>
    <!--panel-body-->
    </section>
</div>
<!-- container-->
<!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script>
     $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });
	  function get_services()
	  {
		services=$(".select2-selection__choice").text();
		service=services.replace(/×/g, ",");
		cus_ser=service.substring(1);
		$("#services").val(cus_ser);
	  }
    </script>
 <?php 
$cm->get_footer("");
?>
