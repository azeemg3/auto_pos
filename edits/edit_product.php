<?php
require_once'../inc.func.php';
if(isset($_GET['product_id']) && !empty($_GET['product_id']))
{
	$product_id=$_GET['product_id'];
	$result=$cm->selectData("products", "product_id=".$product_id."");
	$row=$result->fetch_assoc();
	echo json_encode($row);
}
?>