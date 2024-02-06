<?php 
require_once'../inc.func.php';
$cm->get_header("../");
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
document.title='Ledger A/C';
</script>
<body>
<div class="content-wrapper" id="loadpage">
<?php echo $cm->loader("../"); ?>
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
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Ledger Statement</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <form id="form">
  <div class="col-md-2">
            <div class="form-group">
            <input type="text" name="dt_frm" class="form-control date input-sm" placeholder="Date From" 
            value="<?php echo $cm->today() ?>">
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
            <div class="form-group">
            <input type="text" name="dt_to" class="form-control date input-sm" placeholder="Date To"
            value="<?php echo $cm->today() ?>">
            </div>
        </div>
        <!-- col-lg-2-->
         <div class="col-md-2">
            <div class="form-group">
             <select class="form-control input-sm select2 fetch_trans_acc" name="trans_acc_type">
             	<option value="">A/C Type</option>
             	 <?php echo $cm->trans_acc_type(); ?>
             </select>
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
            <div class="form-group">
             <select class="form-control input-sm select2 selected_trans_acc" name="trans_acc_id">
             	<option value="">Select Ledger A/C</option>
             	
             </select>
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-1">
            <div class="form-group">
             <button type="button" class="btn btn-sm btn-primary" onClick="get_acc_ledger()">
             <i class="fa fa-search"></i> Search</button>
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-3">
             <button type="submit" class="btn btn-sm btn-default" formaction="print_acc_ledger" formmethod="post" formtarget="_blank">
             <i class="glyphicon glyphicon-print"></i></button>
        </div>
        <!-- col-lg-2-->
   </form>
   <div class="clearfix"></div>
   <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
            	<th width="10%">Date</th>
                <th>Voucher</th>
                <th width="15%">Trans A/C</th>
                <th>Description</th>
                <th>DR</th>
                <th>CR</th>
                <th width="10%">Balance</th>
            </tr>
    </thead>
    <tbody id="get_acc_ledger_ob"></tbody>
    <tbody id="get_acc_ledger"></tbody>
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
$cm->get_footer("../");
?>
