<?php 
require_once'inc.func.php';
$cm->get_header("")
?>
<body onLoad="call_ajax('ajax_call/get_userList', 'form', 'get_userList')">
<div class="content-wrapper" id="loadpage">
<section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
        
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">All User List</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
            	<th>#</th>
                <th>User Name</th>
                <th>Account Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th>Date Created</th>
                <th>Action</th>
            </tr>
    </thead>
    <tr>
    	<td class="load" align="center" colspan="10"></td>
    </tr>
    <tbody class="get_userList">
    	
    </tbody>
    </table>
  </div>
</div>
<!--panel panel-default-->
	</div>
    <!--panel-body-->
</div>
<!-- container-->
<?php 
$cm->get_footer("")
?>
