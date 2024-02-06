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
<body>
<!--============================Success modal===========================-->
    <div class="modal fade" id="success-loader">
      <div class="modal-dialog"> 
        <!-- Modal content-->
        <div class="col-sm-12">
          <div class="alert alert-success alert-dismissable">
            <h4> <i class="icon fa fa-check"></i> Alert!</h4>
            Opration Successfull..............<a href="" class="btn btn-default">Add New</a> OR  
            <a href="purchaseList" class="btn btn-default" class="btn btn-default">Ok</a>
            </div>
        </div>
      </div>
    </div>
    <!--============================Success modal===========================--> 
 <!--============================Error modal===========================-->
    <div class="modal fade" id="error-loader">
      <div class="modal-dialog"> 
        <!-- Modal content-->
        <div class="alert alert-danger alert-dismissable">
          <h4><i class="icon fa fa-ban"></i> Alert!</h4>
          <p>Operation Failed</p> </div>
      </div>
    </div>
    <!--============================Error modal===========================-->
<div class="content-wrapper" id="loadpage">
<?php echo $cm->loader(); ?>
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
  Purchase Invoice
  </span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <form id="form">
      <div class="col-md-3">
        <div class="form-group">
          <label>Select Vendor</label>
          <select class="form-control input-sm select2" name="vendor_id">
            <option value="">Select Vendor</option>
            <?php echo $cm->all_vendors(); ?>
            </select>
        </div>
       </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
          <div class="form-group">
            <label>Date</label>
            <input type="text" name="purchase_date" class="form-control input-sm date" value="<?php echo $cm->today(); ?>">
          </div>
        </div>
        <!-- col-lg-2-->
   <div class="clearfix"></div>
   <hr>
   <h4>Make Product List:</h4>
   <div class="multiple_rec">
   <div class="parentRemove">
   <div class="col-md-4">
     <div class="form-group">
       <label>Product Name</label>
       <select class="form-control input-sm select2" name="product_id[]">
         <option value="">Products</option>
         <?php echo $cm->all_products() ?>
       </select>
     </div>
   </div>
   <!--col-md-2-->
   <div class="col-md-2">
     <div class="form-group">
       <label>Rate</label>
       <input type="number" name="rate[]" class="form-control input-sm rate" placeholder="Product Rate">
     </div>
   </div>
   <!--col-md-2-->
   <div class="col-md-2">
     <div class="form-group">
       <label>Qty</label>
       <input type="number" name="qty[]" class="form-control input-sm qty" placeholder="Qty">
     </div>
   </div>
   <!--col-md-1-->
   <div class="col-md-2">
     <div class="form-group">
       <label>Total</label>
       <input type="number" name="total[]" class="form-control input-sm total" placeholder="Total">
     </div>
   </div>
   <!--col-md-2-->
   <div class="col-md-2">
     <div class="form-group">
       <label>Add More</label>
       <div class="clearfix"></div>
       <button type="button" class="btn btn-sm btn-primary multiple_rec_app"><i class="fa fa-plus"></i></button>
     </div>
   </div>
   <!--col-md-2-->
   <div class="clearfix"></div>
   </div>
   </div>
   <div class="col-md-8">
     <div class="form-group">
       <input type="text" name="descriptions" class="form-control input-sm" placeholder="Description">
     </div>
   </div>
   <!--col-md-9-->
   <div class="col-md-6 col-md-offset-4">
   <div class="form-group">
    <label class="col-sm-3" style="margin-top: 5px;">Sub Total</label>
    <div class="col-md-4 row">
    <input type="text" name="sub_total" class="row form-control input-sm" id="sub_total" readonly>
    </div>
    </div>
   </div>
   <!--col-md-6-->
   <div class="col-md-6 col-md-offset-4" style="margin-top: 5px;">
   <div class="form-group">
    <label class="col-sm-3" style="margin-top: 5px;">Net Total</label>
    <div class="col-md-4 row">
    <input type="text" name="net_total" class="row form-control input-sm" id="net_total" readonly>
    </div>
    </div>
   </div>
   <!--col-md-6-->
   <div class="col-md-6 col-md-offset-4" style="margin-top: 5px;">
   <div class="form-group">
    <label class="col-sm-3" style="margin-top: 5px;">Paid</label>
    <div class="col-md-4 row">
    <input type="text" name="paid" class="row form-control input-sm" id="receive">
    </div>
    <div class="col-md-4 row" style="margin-left:5px;">
    <select class="form-control input-sm select2" name="acc_frm">
    	<option value="">Select A/C</option>
        <?php echo $cm->cashBank_acc(); ?>
    </select>
    </div>
    </div>
   </div>
   <!--col-md-6-->
   <div class="col-md-6 col-md-offset-4" style="margin-top: 5px;">
   <div class="form-group">
    <label class="col-sm-3" style="margin-top: 5px;">Balance</label>
    <div class="col-md-4 row">
    <input type="text" name="balance" class="row form-control input-sm" id="balance">
    </div>
    </div>
   </div>
   <!--col-md-6-->
   <div class="col-md-10 col-md-offset-1" style="margin-top: 5px;">
   <div class="form-group">
    <button type="button" name="" class="btn btn-success btn-sm form-control" onClick="purchase_invoice()">Submit</button>
    </div>
   </div>
   <!--col-md-6-->
   </form>
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
	  function get_services()
	  {
		services=$(".select2-selection__choice").text();
		service=services.replace(/×/g, ",");
		cus_ser=service.substring(1);
		$("#services").val(cus_ser);
	  }
	  $(".multiple_rec").delegate(".multiple_rec_app", "click", function(){
	
	$(".multiple_rec").append('<div class="parentRemove"><div class="col-md-4 col-sm-4">'+
                    	'<div class="form-group">'+
                          '<select class="form-control input-sm select2" name="product_id[]" >'+
						   '<option>Products</option>'+
						   '<?php echo $cm->all_products() ?>'+
						  '</select>'+
                       '</div></div>'+
					'<div class="col-lg-2 col-sm-4">'+
                    	'<div class="form-group">'+
                          '<input type="text" name="rate[]" class="form-control input-sm rate" placeholder="Product Rate">'+
                       '</div>'+
                    '<!-- form--group-->'+
					'</div>'+
					'<div class="col-lg-2 col-sm-2">'+
                    	'<div class="form-group">'+
                          '<input type="text" name="qty[]" class="form-control input-sm qty" placeholder="Qty">'+
                       '</div>'+
                    '<!-- form--group-->'+
					'</div>'+
					'<div class="col-lg-2 col-sm-4">'+
                    	'<div class="form-group">'+
                          '<input type="text" name="total[]" class="form-control input-sm total" placeholder="Total">'+
                       '</div>'+
                    '<!-- form--group-->'+
					'</div>'+
					'<div class="col-md-1">'+
					  '<div class="form-group">'+
						'<button type="button" class="btn btn-sm btn-danger remove"><i class="fa fa-trash"></i></button>'+
					  '</div>'+
					'</div>'+
                    '</div><div class="clearfix"></div></div>');
					$(".select2").select2();
});
    </script>
 <?php 
$cm->get_footer("");
?>
