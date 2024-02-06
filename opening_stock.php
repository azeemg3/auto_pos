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
document.title='Opening Stock';
</script>
<body onLoad="call_ajax('ajax_call/os_action','', 'get_stock_det')">
<!--============Modal add new barnds================-->
  <div class="modal fade" id="opening_stock" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onClick="reset_form('proForm')">&times;</button>
          <h4 class="modal-title">Update Stock</h4>
        </div>
        <form id="editForm">
          <input type="hidden" name="stock_id" value="0">
        <div class="modal-body">
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Name</label>
              <div class="clearfix"></div>
              <select class="form-control input-sm select2" name="product_id">
              	<option value="">Products</option>
                <?php echo $cm->all_products() ?>
              </select>
            </div>
          </div>
          <!--col-md-5-->
          <div class="col-md-3">
          <div class="form-group">
            <label>Rate</label>
            <input type="text" name="rate" class="form-control input-sm">
          </div>
        </div>
        <!--col-md-5-->
          <div class="col-md-3">
          <div class="form-group">
            <label>Qty</label>
            <input type="text" name="qty" class="form-control input-sm">
          </div>
        </div>
          <div class="col-md-12">
            <div class="form-group">
              <div class="clearfix"></div>
               <button type="button" class="btn btn-sm btn-success pull-right" onClick="add_opning_stock('editForm')">Update</button>
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
  <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Opening Stock</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <form id="form">
  <input type="hidden" name="stock_id" value="0">
        <div class="col-md-2">
        <div class="form-group">
            <label>Products</label>
            <select class="form-control input-sm select2" name="product_id">
            <option value="">Products</option>
            <?php echo $cm->all_products() ?>
            </select>
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
        <div class="form-group">
            <label>Rate</label>
            <input type="text" name="rate" class="form-control input-sm" placeholder="Rate">
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-1">
            <div class="form-group">
            <label>Qty</label>
            <input type="text" name="qty" class="form-control input-sm" placeholder="Qty"
            value="">
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
          <div class="form-group">
            <label style="visibility: hidden;">afaf</label>
            <div class="clearfix"></div>
            <button type="button" class="btn btn-sm btn-primary" onClick="add_opning_stock('form')">Add</button>
          </div>
        </div>
   </form>
  <div class="clearfix"></div>
  <hr><hr>
  <form id="serchForm">
         <div class="col-md-3">
            <div class="form-group">
             <select class="form-control input-sm select2" name="ser_product" 
             onChange="call_ajax('ajax_call/os_action','serchForm', 'get_stock_det')">
              <option value="">Search Product</option>
               <?php echo $cm->all_products() ?>
             </select>
            </div>
        </div>
        <!--col-lg-2-->
   </form>
   <div class="clearfix"></div>
   <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
      	<th>#</th>
        <th>Product Name</th>
        <th>Rate</th>
        <th>Quantity</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody class="get_stock_det"></tbody>
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
