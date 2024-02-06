<?php
require_once'../inc.func.php';
if(isset($_GET['brand_id']) && !empty($_GET['brand_id']))
{
	$brand_id=$_GET['brand_id'];
	$result=$cm->selectData("brands", "brand_id=".$brand_id."");
	$row=$result->fetch_assoc();
	echo json_encode($row);
}
?>