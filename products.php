<?php 
require_once'inc.func.php';
$cm->get_header("");
?>
<script>
document.title='Transaction A/C';
</script>
<body onLoad="call_ajax('ajax_call/product_action','', 'get_products')">
<div class="content-wrapper">
<!--============Modal add new barnds================-->
  <div class="modal fade" id="product" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onClick="reset_form('proForm')">&times;</button>
          <h4 class="modal-title">Update Brand</h4>
        </div>
        <form id="proForm">
          <input type="hidden" name="product_id" value="0">
        <div class="modal-body">
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Name</label>
              <input type="text" name="product_name" class="form-control input-sm" placeholder="Brand Name">
            </div>
          </div>
          <!--col-md-5-->
          <div class="col-md-6">
            <div class="form-group">
            <label>Purhcase Price</label>
            <input type="text" name="purchase_price" class="form-control input-sm" placeholder="Updated Price">
            </div>
        </div>
        <!-- col-lg-6-->
        <div class="col-md-6">
            <div class="form-group">
            <label>Batch#</label>
            <input type="text" name="batch" class="form-control input-sm" placeholder="Batch#">
            </div>
        </div>
        <!-- col-lg-6-->
          <div class="col-md-6">
            <div class="form-group">
              <label>Brand</label>
              <select class="form-control input-sm" name="brand_id">
              <option>Select Brand</option>
				<?php echo $cm->brands() ?>
            </select>
            </div>
          </div>
          <!--col-md-5-->
          <div class="col-md-6">
          <div class="form-group">
            <label>Expirty Date</label>
            <input type="text" name="exp_date" class="date form-control input-sm">
          </div>
        </div>
          <div class="col-md-2">
            <div class="form-group">
              <label style="visibility: hidden;">Test</label>
              <div class="clearfix"></div>
               <button type="button" class="btn btn-sm btn-success" onClick="add_products('proForm')">Add</button>
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
  All Products
  </span></h2>
<div class="panel panel-default">
  <div class="panel-body">
        <div class="clearfix"></div>
  <form id="form">
  <input type="hidden" name="product_id" value="0">
      <div class="col-md-2">
            <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="product_name" class="form-control input-sm" placeholder="Product Name">
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
            <div class="form-group">
            <label>Purhcase Price</label>
            <input type="text" name="purchase_price" class="form-control input-sm" placeholder="Purchase Price">
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
            <div class="form-group">
            <label>Batch#</label>
            <input type="text" name="batch" class="form-control input-sm" placeholder="Update Batch">
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
            <div class="form-group">
            <label>Select Brand</label>
            <select class="form-control input-sm" name="brand_id">
              <option>Select Brand</option>
				<?php echo $cm->brands() ?>
            </select>
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
          <div class="form-group">
            <label>Expirty Date</label>
            <input type="text" name="exp_date" class="date form-control input-sm">
          </div>
        </div>
        <div class="col-md-2" style="margin-top: 24px;">
          <div class="form-group">
            <button type="button" class="btn btn-sm btn-primary" onClick="add_products('form')">Submit</button>
          </div>
        </div>
   </form>
   <div class="clearfix"></div>
   <hr><hr>
   <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
            	<th width="10%">#</th>
                <th>Product Name</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Batch#</th>
                <th>Expiry Date</th>
                <th width="10%">Action</th>
            </tr>
            <tbody class="get_products">
            </tbody>
    </thead>
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
 <?php 
$cm->get_footer("");
?>
