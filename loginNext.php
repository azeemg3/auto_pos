<?php
session_start();
ob_start();
ob_clean();
require_once'inc.func.php';
if(!empty($_POST['userName']) && $_POST['password'])
{
	/*if(!empty($_POST['lat']))
	{*/
	//$cm->login($_POST['userName'], $_POST['password'], $_POST['lat'], $_POST['long']);
	$cm->login($_POST['userName'], $_POST['password']);
	//}
	/*else
	{
		echo "
			<script>
				alert('Please Allow Your Location For Log in ');
				window.location='login.php';
			</script>
		";
	}*/
}
else
{
	header("location:login?error=error");
	exit;
?>
<script language="JavaScript">
		function move() {
			window.location = 'login';
		}
</script>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel='icon' href='images/logo.png' />
    <title>Login</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body onload="timer=setTimeout('move()',1000)">
<div class="container-fluid">
<div class="row">
<div class="col-sm-12 header">
	<a href="/381"><div class="logo"></div></a>
</div>
<!--col-sm-12 header -->
<div class="col-lg-4 col-md-6 col-sm-4 col-xs-offset-4 login-erro">
 	<p> <span>Error:</span> You Entered  Wrong Username Or Password *</p>   	
</div>
 <!-- main_login-form-->
 <?php } ?>
  </div>
  <!--row -->
</div>
<!-- container-fluid-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="js/jquery-min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>