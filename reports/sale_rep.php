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
document.title='Invoices List';
</script>
<body onLoad="call_ajax('../ajax_call/get_inv_rep','', 'get_inv_rep')">
<?php echo $cm->loader() ?>
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
  <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Sale Report</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <form id="serchForm">
   <div class="col-md-2">
    <div class="form-group">
     <input type="text" name="df" class="form-control input-sm date" placeholder="Date From" />
    </div>
   </div>
   <div class="col-md-2">
    <div class="form-group">
     <input type="text" name="dt" class="form-control input-sm date" placeholder="Date To" />
    </div>
   </div>
   <div class="col-md-2">
    <div class="form-group">
     <input type="text" class="form-control input-sm" placeholder="Invoice No" name="inv_no" />
    </div>
   </div>
   <div class="col-md-2">
    <div class="form-group">
     <select class="form-control input-sm select2" name="client_id">
     	<option value="">Select Client</option>
        <?php echo $cm->all_clients() ?>
     </select>
    </div>
   </div> 
   <div class="col-md-1">
    <div class="form-group">
     <button type="button" class="btn btn-sm btn-primary" onClick="call_ajax('../ajax_call/get_inv_rep','serchForm', 'get_inv_rep')"><i class="fa fa-search"></i> Search</button>
    </div>
   </div> 
   <div class="col-md-1">
    <div class="form-group">
     <button type="button" onClick="PrintMe()" class="btn btn-sm btn-default"><i class="fa fa-print"></i></button>
    </div>
   </div>   
  </form>
   <div class="clearfix"></div>
   <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
      	<th>Invoice No</th>
        <th>Date</th>
        <th>Client Name</th>
        <th>Total Amount</th>
      </tr>
    </thead>
    <tbody class="get_inv_rep"></tbody>
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
<script language="javascript">
function PrintMe() {
var disp_setting="toolbar=yes,location=no,";
disp_setting+="directories=yes,menubar=yes,";
disp_setting+="scrollbars=yes,width=1000, height=800, left=100, top=25";
   var content_vlue = $(".get_inv_rep").html();
   var docprint=window.open("","",disp_setting);
   docprint.document.open();
   docprint.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"');
   docprint.document.write('"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
   docprint.document.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">');
   docprint.document.write('<head>');
   docprint.document.write('<link href="../bootstrap/css/printXo.css" type="text/css" rel="stylesheet">');
   docprint.document.write('<style type="text/css">body{ margin:0px;@page {size: auto;margin:1 auto;}');
   docprint.document.write('font-family:verdana,Arial;color:#000;');
   docprint.document.write('font-family:Verdana, Geneva, sans-serif; font-size:12px;}');
   docprint.document.write('a{color:#000;text-decoration:none;} </style>');
   docprint.document.write('</head><body onLoad="self.print()"><center>');
   docprint.document.write('<div id="print"><div id="wrapper">');
   docprint.document.write('<div id="header">');
   docprint.document.write('<div id="tvt"><img width="180" src="../images/deutech.png"></div>');//images
    docprint.document.write('<div id="header-mid">');
	 docprint.document.write('<div id=""><h3>DEU TECH PHARMACEUTICALS</h3></div>');
	 docprint.document.write('<p align="center"></p>');
	docprint.document.write('</div>');
   docprint.document.write('</div>');
   docprint.document.write('</div></div><div style="clear:both;"></div>');
   docprint.document.write('<table border="1" width="100%" style="text-align:center">');
   docprint.document.write('<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; margin-top:20px;" id="printTr">');
   docprint.document.write('<th>Invoice No</th><th>Date</th><th>Client Name</th><th>Total</th>');
   docprint.document.write('</tr>');
   docprint.document.write(content_vlue);
   docprint.document.write('</table>');
   docprint.document.write('</center></body></html>');
   docprint.document.close();
   docprint.focus();
}
</script>
