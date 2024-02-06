<?php
require_once'../inc.func.php';
if(isset($_GET['trans_acc_id']) && !empty($_GET['trans_acc_id']))
{
	$trans_acc_id=$_GET['trans_acc_id'];
	$result=$cm->selectData("trans_acc", "trans_acc_id=".$trans_acc_id."");
	$row=$result->fetch_assoc();
	echo json_encode($row);
}
?>