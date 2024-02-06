<?php
require_once'inc.func.php';

$cm->get_header();

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
document.title='Stock List';
</script>
<body onLoad="call_ajax('ajax_call/get_stockList','', 'get_stockList')">

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
  <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Stock Lists</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
   <div class="clearfix"></div>
   <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
        <th>Product Name</th>
        <th>Brand Name</th>
        <th>Quantity</th>
      </tr>
    </thead>
    <tbody class="get_stockList"></tbody>
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
    function get_services()
    {
    services=$(".select2-selection__choice").text();
    service=services.replace(/×/g, ",");
    cus_ser=service.substring(1);
    $("#services").val(cus_ser);
    }
    </script>
 <?php 
$cm->get_footer("");
?>
