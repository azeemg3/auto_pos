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
document.title='Sale Invoice';
</script>
<body>
<!--============================Success modal===========================-->
    <div class="modal fade" id="success-loader">
      <div class="modal-dialog"> 
        <!-- Modal content-->
        <div class="col-sm-12">
          <div class="alert alert-success alert-dismissable">
            <h4> <i class="icon fa fa-check"></i> Alert!</h4>
            Opration Successfull..............<a href="" class="btn btn-link">Add New</a> OR  
            <a href="invList"  class="btn btn-primary">Ok</a> OR 
            <a target="_blank" id="printInv" class="btn btn-info btn-sm"><i class="fa fa-print"></i></a>
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
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
    <section class="content">
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">
  Sale Invoice
  </span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <form id="form">
      <div class="col-md-3">
        <div class="form-group">
          <label>Select Customer</label>
          <select class="form-control input-sm select2" name="client_id" onchange="rem_balance(this.value)">
            <option value="">Select Customer</option>
            <?php echo $cm->all_clients(); ?>
          </select>
        </div>
       </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
          <div class="form-group">
            <label>Date</label>
            <input type="text" name="sale_date" class="form-control input-sm date" value="<?php echo $cm->today(); ?>">
          </div>
        </div>
        <!-- col-lg-2-->
	<div class="clearfix"></div>
	<div class="col-md-6">
	 <div class="form-group">
          <input type="text" class="form-control" id="rem_bal">
	 </div>
	</div>     
   <div class="clearfix"></div>
   <hr>
   <h4>Make Product List:</h4>
   <div class="multiple_rec">
   <div class="parentRemove">
   <div class="col-md-4">
     <div class="form-group">
       <label>Product Name</label>
       <select name="product_id[]" class="form-control input-sm select2 thisProduct">
         <option value="">Products</option>
         <?php echo $cm->all_products(); ?>
       </select>
     </div>
   </div>
   <!--col-md-2-->
   <div class="col-md-2">
     <div class="form-group row">
       <label>Previous Qty</label>
       <input type="text" name="" class="form-control input-sm remPro">
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
   <div class="col-md-1">
     <div class="form-group">
       <label>Qty</label>
       <input type="text" name="qty[]" class="form-control input-sm qty" placeholder="Qty">
     </div>
   </div>
   <!--col-md-1-->
   <div class="col-md-2">
     <div class="form-group">
       <label>Total</label>
       <input type="text" name="total[]" class="form-control input-sm total" placeholder="Total">
     </div>
   </div>
   <!--col-md-2-->
   <div class="col-md-1">
     <div class="form-group">
      <label>More</label>
       <div class="clearfix"></div>
       <button type="button" class="btn btn-sm btn-primary multiple_rec_app"><i class="fa fa-plus"></i></button>
     </div>
   </div>
   <!--col-md-2-->
   <div class="clearfix"></div>
   </div>
   </div>
   <!--multip-record-->
   <div class="col-md-10">
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
    <label class="col-sm-3" style="margin-top: 5px;">Discount</label>
    <div class="col-md-4 row">
    <input type="text" name="discount" class="row form-control input-sm" id="discount" placeholder="Disount Amount">
    </div>
    <div class="col-md-4 row" style="margin-left:5px;">
    <input type="text" name="discount_per" class="row form-control input-sm" id="discount_per" placeholder="Discount %">
    </div>
    </div>
   </div>
   <!--col-md-6-->
   <div class="col-md-6 col-md-offset-4" style="margin-top: 5px;">
   <div class="form-group">
    <label class="col-sm-3" style="margin-top: 5px;">GST</label>
    <div class="col-md-4 row">
    <input type="text" name="gst" class="row form-control input-sm" id="gst">
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
   <div class="col-md-6 col-md-offset-4" style="margin-top:5px;">
   <div class="form-group">
    <label class="col-sm-3" style="margin-top: 5px;">Received</label>
    <div class="col-md-4 row">
    <input type="text" name="receive" class="row form-control input-sm" id="receive">
    </div>
    </div>
   </div>
    <!--col-md-6-->
    <div class="col-md-6 col-md-offset-4" style="margin-top:5px;">
   <div class="form-group">
    <label class="col-sm-3" style="margin-top: 5px;">Balance</label>
    <div class="col-md-4 row">
    <input type="text" name="" class="row form-control input-sm" id="balance">
    </div>
    </div>
   </div>
    <!--col-md-6-->
   <div class="col-md-10 col-md-offset-1" style="margin-top: 5px;">
   <div class="form-group">
    <button type="button" name="descriptions" class="btn btn-success btn-sm form-control" onClick="sale_invoice()">Submit</button>
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
	  // add multiple products list
$(".multiple_rec").delegate(".multiple_rec_app", "click", function(){
	
	$(".multiple_rec").append('<div class="parentRemove"><div class="col-md-4 col-sm-4">'+
                    	'<div class="form-group">'+
                          '<select name="product_id[]" class="form-control input-sm select2 thisProduct" >'+
						   '<option>Products</option>'+
						   '<?php echo $cm->all_products(); ?>'+
						  '</select>'+
                       '</div></div>'+
					    '<div class="col-lg-2 col-sm-4">'+
                    	'<div class="form-group row">'+
                          '<input type="text" name="" class="form-control input-sm remPro">'+
                       '</div>'+
                    '<!-- form--group-->'+
					'</div>'+
					'<div class="col-lg-2 col-sm-4">'+
                    	'<div class="form-group">'+
                          '<input type="text" name="rate[]" class="form-control input-sm rate" placeholder="Product Rate">'+
                       '</div>'+
                    '<!-- form--group-->'+
					'</div>'+
					'<div class="col-lg-1 col-sm-2">'+
                    	'<div class="form-group">'+
                          '<input type="text" name="qty[]" class="form-control input-sm qty" placeholder="Qty">'+
                       '</div>'+
                    '<!-- form--group-->'+
					'</div>'+
				   '<!--col-md-1-->'+
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
