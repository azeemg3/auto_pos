<?php 
require_once'../inc.func.php';
$cm->get_header("../");
?>
<style type="text/css">
  
  .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 34px;
    user-select: none;
    -webkit-user-select: none;
    border-radius: 0px;
	height: 30px !important;
}
.select2
{
	width:100% !important;
}
</style>
<script>
document.title='Transaction A/C';
</script>
<body onLoad="call_ajax('ajax_call/get_transaction','', 'get_transaction')">
<?php echo $cm->loader(); ?>
<!-- ==================Modal for Edit trans account====================-->
<div class="modal fade" id="transaction" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Journal:</h4>
        </div>
        <div class="col-sm-8 col-sm-offset-2 alert alert-success alert-dismissable success-load" style="display:none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
            Transaction Successfully.
        </div>
        <div class="col-sm-8 col-sm-offset-2 alert alert-danger alert-dismissable error-load" style="display:none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              Something Wrong With your Query.      
        </div>
        <div class="clearfix"></div>
         <form id="trans_acc_form">
         <input type="hidden" name="trans_code">
        <div class="modal-body">
          <p><div class="panel panel-default">
            <div class="panel-body">
                <div class="col-sm-6">
                	<div class="form-group">
                    	<label>Transaction Date</label>
                    	<input type="text" class="form-control input-sm date" name="trans_date" placeholder="Transaction Date"
                        value="<?php echo $cm->today(); ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                	<div class="form-group">
                    	<label>Voucher Type</label>
                    	<select class="form-control input-sm" name="vt">
                        	<?php echo $cm->vt(); ?>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-12">
                	<div class="form-group">
                    	<select class="form-control select2 trans_from" name="trans_from">
                        	<option value="">From</option>
                          	<?php echo $cm->trans_acc(); ?>
                        </select>
                    </div>
                </div>
                 <div class="col-sm-12">
                	<div class="form-group">
                    	<select  class="form-control select2 trans_to" name="trans_to">
                        	<option value="">To</option>
                            <option value="">Select A/C</option>
                          	<?php echo $cm->trans_acc(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                	<div class="form-group">
                        <input type="text" class="form-control input-sm number" placeholder="Amount" name="amount">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-12">
                	<div class="form-group">
                    	<label>Narration </label>
                    	<input type="text" class="form-control input-sm" name="short_address">
                    </div>
                </div>
            </div>
            <!-- panel-body-->
          </div>
          <!--panel-default-->
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success input-sm" onClick="trans_action()" >Submit</button>
          <button type="button" class="btn btn-warning input-sm" data-dismiss="modal" onClick="empty_fields('new-vendor')">Cancel</button>
        </div>
        </form>
      </div>
      
    </div>
</div>
<!-- ==================Modal for Edit trans account====================-->
<div class="content-wrapper">
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
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Transaction A/C</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <form id="searchForm">
         <div class="col-md-2">
            <div class="form-group">
             <input type="text" name="df" placeholder="Search From Date" class="form-control input-sm date">
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
            <div class="form-group">
             <input type="text" name="dt" placeholder="Search To Date" class="form-control input-sm date">
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-3">
            <div class="form-group">
             <select class="form-control input-sm select2" name="trans_acc">
             	<option value="">Select A/C</option>
                <?php echo $cm->trans_acc() ?>
             </select>
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-1">
            <div class="form-group">
             <button type="button" class="btn btn-sm btn-primary" 
             onClick="call_ajax('ajax_call/get_transaction','searchForm', 'get_transaction')">
             <i class="fa fa-search"></i> Search</button>
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-4">
            <div class="form-group">
             <button type="button" class="btn btn-sm btn-success pull-right" onClick="addNew_trans()">New Transaction</button>
            </div>
        </div>
        <!-- col-lg-2-->
   </form>
   <div class="clearfix"></div>
   <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
            	<th>Voucher#</th>
                <th>Date</th>
                <th>A/C Name</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
    </thead>
    <tbody class="get_transaction"></tbody>
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
    </script>
 <?php 
$cm->get_footer("../");
?>
