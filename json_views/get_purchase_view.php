<?php
require_once'../inc.func.php';
$array=array();
if(isset($_GET['p_id']) && !empty($_GET['p_id']))
{
	$pId=$_GET['p_id'];
	$result=$cm->selectData("stock_details", "pi_id=".$pId."");
	while($row=$result->fetch_assoc())
	{
		$vId=$cm->u_value("purchase_invoice","vendor_id","p_id=".$row['pi_id']."");
		$arrayofArray['all_data']=array("product_name"=>$cm->u_value("products", "product_name", "product_id=".$row['product_id'].""), "rate"=>$row['rate'], "qty"=>$row['qty'], "total"=>$row['total'], "client_name"=>$cm->u_value("trans_acc","trans_acc_name",
		"trans_acc_id=".$vId.""));
		$array[]=$arrayofArray;
	}
	echo json_encode($array);
}
?>