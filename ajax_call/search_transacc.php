<?php
require_once'../inc.func.php';
session_start();
$rows=array();
if(isset($_GET['acc_type']) && !empty($_GET['acc_type']))
{
	$acc_type=$_GET['acc_type'];
	$result=$cm->selectData("trans_acc","trans_acc_type='".$acc_type."'");
	while($row=$result->fetch_assoc())
	{
		$rows[]=$row;
	}
	echo json_encode($rows);
}
?>