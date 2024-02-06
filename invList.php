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
document.title='Invoices List';
</script>
<body onLoad="call_ajax('ajax_call/get_invList','', 'get_invList')">
<?php require_once'modals/sale_invoice_view.php'; ?>
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
  <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Sale Invoices List</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <form id="serchForm">
     <div class="col-md-2">
     	<div class="form-group">
        	<input type="text" name="df" class="form-control input-sm date" placeholder="Date From">
        </div>
     </div>
     <!--col-md-2-->
     <div class="col-md-2">
     	<div class="form-group">
        	<input type="text" name="inv_no" class="form-control input-sm" placeholder="Invoice Number">
        </div>
     </div>
     <!--col-md-2-->
     <div class="col-md-1">
      <button type="button" class="btn btn-sm btn-primary" onClick="call_ajax('ajax_call/get_invList','serchForm', 'get_invList')">
      <i class="fa fa-search"></i> Search</button>
     </div>
   </form>
   <div class="clearfix"></div>
   <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
      	<th>Invoice No</th>
        <th>Date</th>
        <th>Client Name</th>
        <th>Total Amount</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody class="get_invList"></tbody>
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
  <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script> 
    <script>
     $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });
    </script>
 <?php 
$cm->get_footer("");
?>
