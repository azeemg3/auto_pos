<?php
require_once'../inc.func.php';
if(isset($_GET['stock_id']) && !empty($_GET['stock_id']))
{
	$stock_id=$_GET['stock_id'];
	$result=$cm->selectData("opening_stock", "stock_id=".$stock_id."");
	$row=$result->fetch_assoc();
	echo json_encode($row);
}
?>