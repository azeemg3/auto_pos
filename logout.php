<?php
session_start();
if(isset($_SESSION['session_crmuserName']))
{
  unset($_SESSION['session_crmuserName']);
  
  //mysql_query("UPDATE user SET online='no' WHERE id=".$_SESSION['sessionId']."");
  if(isset($_SESSION['sessionId']))
  unset($_SESSION['sessionId']);
  header('Location:index.php');	
}
else
{
	header("location:loginNext.php?error=error");
}
?>
