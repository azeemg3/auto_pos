<?php 
require_once'../inc.func.php';
$cm->get_header("../");
$row=NULL;
if(isset($_GET['trans_code']) && !empty($_GET['trans_code']))
{
	$trans_code=$_GET['trans_code'];
	$result=$cm->selectData("trans", "trans_code=".$trans_code." AND status='approved'");
	$row=$result->fetch_assoc();
	$tf=$cm->u_value("trans","trans_acc_id","trans_code=".$trans_code." AND dr_cr='cr' AND status='approved'");
	$tt=$cm->u_value("trans","trans_acc_id","trans_code=".$trans_code." AND dr_cr='dr' AND status='approved'");
}
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
    <div class="col-md-6 col-md-offset-3">
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Transaction A/C</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <form action="update_transaction" method="post">
   <input type="hidden" name="trans_code" value="<?php echo $trans_code ?>">
  <div class="col-md-6">
    <div class="form-group">
        <label>Transaction Date</label>
        <input type="text" class="form-control input-sm date" name="trans_date" placeholder="Transaction Date"
        value="<?php echo $row['trans_date'] ?>">
    </div>
  </div>
        <!-- col-lg-2-->
        <div class="col-md-6">
            <div class="form-group">
                <label>Voucher Type</label>
                <select class="form-control input-sm" name="vt">
                    <?php echo $cm->vt($row['vt']); ?>
                </select>
            </div>
        </div>
        <!-- col-lg-2-->
         <div class="col-sm-12">
            <div class="form-group">
                <select class="form-control select2 trans_from" name="trans_from">
                    <option value="">From</option>
                    <?php echo $cm->trans_acc_e($tf); ?>
                </select>
            </div>
        </div>
        <!-- col-lg-12-->
        <div class="col-sm-12">
            <div class="form-group">
                <select  class="form-control select2 trans_to" name="trans_to">
                    <option value="">To</option>
                    <option value="">Select A/C</option>
                    <?php echo $cm->trans_acc_e($tt); ?>
                </select>
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-12">
            <div class="form-group">
                <input type="text" class="form-control input-sm number" placeholder="Amount" name="amount" 
				value="<?php echo $row['amount'] ?>">
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-sm-12">
                	<div class="form-group">
                    	<label>Narration </label>
                    	<input type="text" class="form-control input-sm" name="short_address" 
                        value="<?php echo $row['narration'] ?>">
                    </div>
                </div>
        <!-- col-lg-2-->
        <div class="clearfix"></div>
        <div class="col-md-6">
        	<button type="submit" class="btn btn-success input-sm" >Update</button>
        </div>
   </form>
</div>
<!--panel panel-default-->
	</div>
    <!--panel-body-->
    </div>
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
