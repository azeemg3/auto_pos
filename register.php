<?php 
require_once'inc.func.php';
$cm->get_header("");
$row=NULL;
$actions[]="";
$query="";
$email="";
if(isset($_POST) && !empty($_POST))
{
	$id=$_POST['id'];
	$actions=$_POST['actions'];
	$date_time=date("d-m-Y G:i:s");
	if(isset($_POST['password'])){ $password=md5($_POST['password']); }
	else { $password=$cm->u_value("user","password", "email='".$_POST['email']."'"); }
	$data=array("name, password, email, phone, status");
	$values=array($_POST['name'], $password, $_POST['email'], $_POST['mobile'],'active');
	$check_user_query=$cm->selectData("user", "email='".$_POST['email']."'");
	if($id=="" || $id==0){
		if($check_user_query->num_rows>=1)
	{
		echo '<div class="col-lg-5 col-md-6 col-sm-5 col-xs-offset-4" style="padding:2%;">
				<div class="alert alert-danger">
				<strong>Error!</strong> Thsis User Name is Already Exists.<a onclick=history.go(-1)>Go Back</a>
			  </div>  	
			</div>';
			exit();
	}
	$cm->insertData("user", $data, $values );
	$user_id=$cm->u_value("user", "id", "1 ORDER BY id DESC");
	foreach($actions as $actions)
	{
		//mysql_query("INSERT INTO action (action, date_created, user_id) VALUES('$actions', '$date_time', '$user_id')");
		$cm->insertData_multi("action", "action, date_created, user_id", "'$actions', '$date_time', '$user_id'");
	}
	echo 
		"
			<script>alert('User Added Successfully Please visit your email for user name and Password');
			window.location='userlist';
			</script>
		";
		exit;
	}
	else
	{
		$values=array("name"=>$_POST['name'], "password"=>$password, "email"=>$_POST['email'],
		"phone"=>$_POST['mobile'], "date_modified"=>date('d-m-Y G:i:s'), "status"=>'active');
		foreach($values as $values=>$columns)
		{
			$query.=$values."='".$columns."',";
		}
		$query=rtrim($query, ",");
		$cm->update("user", $query, "id=".$id."");
		$cm->delete("action", "user_id=".$id."");
		foreach($actions as $actions)
	{
		//mysql_query("INSERT INTO action (action, date_created, user_id) VALUES('$actions', '$date_time', '$id')");
		$cm->insertData_multi("action", "action, date_created, user_id", "'$actions', '$date_time', '$id'");
	}
	echo '
	<script type="text/javascript">
				function move() {
			window.location = "userlist";
			$(".login-erro").fadeIn(fast).fadeOut(slow);
		}
			</script>
			<body onload="move()">
			<div class="col-lg-4 col-md-6 col-sm-4 col-xs-offset-4" style="padding:2%;">
				<div class="alert alert-success">
				  <strong>Success!</strong> User Updated Successfully.
				</div>  	
			</div>
			</body>
			
		';
		exit();
	}
}
else if(!empty($_GET['userid']))
{
	$id=$_GET['userid'];
	$query=$cm->selectData("user", "id=".$id."");
	$row=$query->fetch_assoc();
	$user_branch=$row['branch_id'];
	$action_query=$cm->selectData("action", "user_id=".$id."");
	while($action=$action_query->fetch_assoc())
	{
		$actions[]=$action['action'];
	}
}
?>
<body onLoad="loadpage()">
<div class="content-wrapper" id="loadpage">
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Add New User</span></h2>
  <div class="panel panel-default">
    <div class="panel-body">
      <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="col-lg-12 col-sm-12 col-xs-12 row">
          <div class="col-lg-3 col-sm-6">
            <div class="form-group">
              <label>Full Name</label>
              <input type="text" id="name" name="name" required value="<?php echo $row['name'] ?>" 
                         class="form-control input-sm">
            </div>
            <!-- form--group--> 
          </div>
          <!--co-lg-3-->
          <div class="col-lg-3 col-sm-6">
            <div class="form-group">
              <label>Password: </label>
              <input type="password" name="password" required  class="form-control input-sm" <?php if(!empty($row['password'])){ echo ' style="display:none;" disabled'; } ?> id="password">
              <?php if(!empty($row['password'])) { ?>
              <input type="button" value="Change Password" class="form-control btn-warning btn-sm" style="margin-top:-5px;" />
              <?php } ?>
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-lg-3 col-sm-6">
            <div class="form-group">
              <label>Email:</label>
              <input type="text" name="email" required value="<?php echo $row['email'] ?>" class="form-control input-sm">
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-lg-3 col-sm-6">
            <div class="form-group">
              <label>Mobile : </label>
              <input type="text" name="mobile"  required value="<?php echo $row['phone'] ?>" class="form-control input-sm">
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="clearfix"></div>
          <h3>Actions</h3>
          <div class="col-lg-12 col-xs-12 col-sm-12">
          <?php if($cm->user_access("adminstrator",$_SESSION['sessionId'])){  ?>
            <label class="checkbox-inline">
              <input type="checkbox" value="adminstrator" name="actions[]" <?php if(in_array('adminstrator', $actions)): echo ' checked="checked"'; endif; ?>>
              Administrator </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="data_entry" name="actions[]" <?php if(in_array('data_entry', $actions)): echo ' checked="checked"'; endif; ?>>
              Data Entry Operator </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="edit" name="actions[]" <?php if(in_array('edit', $actions)): echo ' checked="checked"'; endif; ?>>
               Edit </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="delete" name="actions[]" <?php if(in_array('delete', $actions)): echo ' checked="checked"'; endif; ?>>
              Delete </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="cms" name="actions[]" <?php if(in_array('cms', $actions)): echo ' checked="checked"'; endif; ?>>
              CMS </label>
              <?php } ?>
          </div>
        </div>
        <!-- col-lg-12-->
        <div class="clearfix"></div>
        <div class="col-lg-2 col-xs-12 col-sm-6 pull-right">
                    <?php if($row['id']=="") { ?>
                    <button class="btn btn-primary col-xs-12 col-sm-12" >Register</button>
                    <?php } else {?>
                    <button class="btn btn-primary col-xs-12 col-sm-12" >Update</button>
                    <?php } ?>
          </div>
      </form>
    </div>
    <!-- panel-body--> 
  </div>
  <!--panel-default--> 
</div>
<!-- container-->
<?php $cm->get_footer("") ?>
<script>
 	$(".btn-warning").on("click", function(){
		$(this).hide();
		$("#password").show();
		$("#password").removeAttr("disabled");
	});
 </script>
 <?php
 //$2y$10$kEAQZJVlC2AzSN0gUgev3Oa/Uz/JOOGaDlhPdbQKiVU...
 ?>