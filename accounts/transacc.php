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
document.title='Transaction A/C';
</script>
<body onLoad="call_ajax('../ajax_call/trans_acc_action','', 'get_trans_acc')">
<!-- ==================Modal for Edit trans account====================-->
<div class="modal fade" id="transacc" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onClick="reset_form('editForm')">&times;</button>
          <h4 class="modal-title">Update Account</h4>
        </div>
        <form id="editForm">
          <input type="hidden" name="trans_acc_id" value="0">
        <div class="modal-body">
          <div class="col-md-6">
            <div class="form-group">
              <label>A/C Type</label>
              <select class="form-control input-sm" name="trans_acc_type">
              <option value="">Select A/C Type</option>
              <?php echo $cm->trans_acc_type(); ?>
            </select>
            </div>
          </div>
          <!--col-md-5-->
          <div class="col-md-6">
            <div class="form-group">
              <label>A/C Name</label>
              <input type="text" class="form-control input-sm" name="trans_acc_name">
            </div>
          </div>
          <!--col-md-5-->
          <div class="col-md-6">
          <div class="form-group">
            <label>Balance Type</label>
             <select class="form-control input-sm" name="dr_cr">
             	<?php echo $cm->dr_cr() ?>
             </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Amount</label>
             <input type="text" name="amount" class="form-control input-sm">
          </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
            <label>City</label>
             <select class="form-control input-sm" name="city_name">
             	<option value="">Select City</option>
                <?php echo $cm->cities() ?>
             </select>
            </div>
        </div>
        <!-- col-lg-6-->
        <div class="col-md-6">
            <div class="form-group">
            <label>Area</label>
             <select class="form-control input-sm" name="area_name">
             	<option value="">Select Area</option>
                <?php echo $cm->areas() ?>
             </select>
            </div>
        </div>
        <!-- col-lg-6-->
        <div class="col-md-10">
          <div class="form-group">
             <input type="text" name="trans_acc_address" class="form-control input-sm" placeholder="Description">
          </div>
        </div>
          <div class="col-md-2">
            <div class="form-group">
              <div class="clearfix"></div>
               <button type="button" class="btn btn-sm btn-success" onClick="add_new_acc('editForm')">Update</button>
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
<!-- ==================Modal for Edit trans account====================-->
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
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Transaction A/C</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <form id="form">
   <input type="hidden" name="trans_acc_id" value="0">
  <div class="col-md-2">
            <div class="form-group">
            <label>A/c Type</label>
            <select class="form-control input-sm" name="trans_acc_type">
              <option value="">Select A/C Type</option>
              <?php echo $cm->trans_acc_type(); ?>
            </select>
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
            <div class="form-group">
            <label>A/C Name</label>
            <input type="text" name="trans_acc_name" class="form-control input-sm" placeholder="Account Name"
            value="">
            </div>
        </div>
        <!-- col-lg-2-->
         <div class="col-md-2">
            <div class="form-group">
            <label>Balance Type</label>
             <select class="form-control input-sm" name="dr_cr">
             	<?php echo $cm->dr_cr() ?>
             </select>
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
            <div class="form-group">
            <label>Amount</label>
             <input type="text" name="amount" class="form-control input-sm " name="amount" placeholder="OB Amount">
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
            <div class="form-group">
            <label>City</label>
             <select class="form-control input-sm" name="city_name">
             	<option value="">Select City</option>
                <?php echo $cm->cities() ?>
             </select>
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
            <div class="form-group">
            <label>Area</label>
             <select class="form-control input-sm" name="area_name">
             	<option value="">Select Area</option>
                <?php echo $cm->areas() ?>
             </select>
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="clearfix"></div>
        <div class="col-md-8">
          <div class="form-group">
            <input type="text" name="trans_acc_address" class="form-control input-sm" placeholder="Description">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <button type="button" class="btn btn-sm btn-primary" onClick="add_new_acc('form')">Submit</button>
          </div>
        </div>
   </form>
  <div class="clearfix"></div>
  <hr><hr>
  <form id="searchForm">
         <div class="col-md-2">
            <div class="form-group">
             <select class="form-control input-sm" name="ser_trans_acc_type">
             	<option value="">A/C Type</option>
             	 <?php echo $cm->trans_acc_type() ?>
             </select>
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
            <div class="form-group">
             <input type="text" class="form-control input-sm" name="trans_acc_name" placeholder="Search A/C Name">
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-1">
            <div class="form-group">
             <button type="button" class="btn btn-sm btn-primary" onClick="call_ajax('../ajax_call/trans_acc_action','searchForm', 'get_trans_acc')">
             <i class="fa fa-search"></i> Search</button>
            </div>
        </div>
        <!-- col-lg-2-->
   </form>
   <div class="clearfix"></div>
   <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
            	<th width="10%">A/C Name</th>
                <th>A/C </th>
                <th>City</th>
                <th>Area</th>
                <th width="12%">Amount</th>
                <th>Description</th>
                <th width="10%">Action</th>
            </tr>
    </thead>
    <tbody class="get_trans_acc"></tbody>
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
   
    <script>
     $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });
    </script>
 <?php 
$cm->get_footer("../");
?>
