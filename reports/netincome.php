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
<body>
<div class="content-wrapper">
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
    <div class="col-md-6 col-md-offset-3">
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Net Income & Expense</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <form id="form">
  	<div class="col-md-4">
    	<div class="form-group">
        	<input type="text" name="df" class="form-control input-sm date" placeholder="Date From">
        </div>
    </div>
    <div class="col-md-4">
    	<div class="form-group">
        	<input type="text" name="dt" class="form-control input-sm date" placeholder="Date To">
        </div>
    </div>
    <div class="col-md-4">
    	<div class="form-group">
        	<button type="button" class="btn btn-sm btn-primary" onClick="net_income()"><i class="fa fa-search"></i> Search</button>
        </div>
    </div>
    <div class="clearfix"></div>
    <table class="table table-bordered table-striped">
    	<thead>
        	<tr>
            	<th>Gross Profit</th>
                <th><span id="gp">0.00</span></th>
            </tr>
            <tr>
            	<th>(-)Expense</th>
                <th><span id="texp">0.00</span></th>
            </tr>
            <tr>
            	<th>Net Income/ Loss</th>
                <th><span id="netincome">0.00</span></th>
            </tr>
        </thead>
    </table>
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
