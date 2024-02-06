<?php
require_once'../inc.func.php';
$array=array();
$sRow=NULL;
if(isset($_GET['s_id']) && !empty($_GET['s_id']))
{
	$sId=$_GET['s_id'];
	$query=$cm->selectData("sale_invoice","s_id=".$sId."");
	$sRow=$query->fetch_assoc();
	$result=$cm->selectData("stock_details", "si_id=".$sId."");
	while($row=$result->fetch_assoc())
	{
		$cId=$cm->u_value("sale_invoice","client_id","s_id=".$row['si_id']."");
		$arrayofArray['all_data']=array("product_name"=>$cm->u_value("products", "product_name", "product_id=".$row['product_id'].""), "rate"=>$row['rate'], "qty"=>$row['qty'], "total"=>$row['total'], "client_name"=>$cm->u_value("trans_acc","trans_acc_name",
		"trans_acc_id=".$cId.""), "bonus_qty"=>$row['bonus_qty']);
		$arrayofArray['discount']=$sRow['discount'];
		$arrayofArray['gst']=$sRow['gst'];
		$arrayofArray['gst']=$sRow['gst'];
		$arrayofArray['net_total']=$sRow['net_total'];
		$arrayofArray['receive']=$sRow['receive'];
		$arrayofArray['balance']=$sRow['net_total']-$sRow['receive'];
		$array[]=$arrayofArray;
	}
	echo json_encode($array);
}
?>