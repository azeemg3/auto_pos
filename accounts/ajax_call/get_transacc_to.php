<?php
require_once('../../inc.func.php');
session_start();
if(isset($_GET['trans_id']) && !empty($_GET['trans_id']))
{
	$trans_id=$_GET['trans_id'];
	echo $cm->trans_acc($trans_id);
}
?>