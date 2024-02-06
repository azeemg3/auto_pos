<?php
require_once'../../inc.func.php';
$sWhere=""; $whereArr=array(); $id="";
if(isset($_POST['area_name']))
{
	if(!empty($_POST['df']) && !empty($_POST['dt']))
	{
		 $dates="AND STR_TO_DATE(sale_invoice.sale_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$_POST['df']."', '%d-%m-%Y') AND STR_TO_DATE('".$_POST['dt']."', '%d-%m-%Y ')";
	}
	else
	{
		$dates="";
	}
$result=$cm->selectMultiData("stock_details.product_id,SUM(stock_details.qty) as total,sale_invoice.client_id,sale_invoice.sale_date","`sale_invoice` LEFT JOIN `stock_details` ON stock_details.si_id=sale_invoice.s_id", "sale_invoice.client_id IN (SELECT trans_acc_id FROM trans_acc WHERE area_name='".$_POST['area_name']."') $dates GROUP BY product_id");
$data=""; $st=0; $count=1;
while($row=$result->fetch_assoc())
{
	//clients area wise
	//$cResult=$cm->selectData("trans_acc","area_name='".$row['area_name']."' AND trans_acc_type='Client'");
	$id=$row['product_id'];
	$data.='
			<tr>
				<td>'.$count++.'</td>
				<td>'.$cm->u_value("products","product_name","product_id=".$row['product_id']."").'</td>
				<td>'.$cm->u_value("trans_acc","area_name","trans_acc_id=".$row['client_id']."").'</td>
				<td>'.$row['total'].'</td>
			</tr>
		';
}
$data.=$cm->nothing_found($id, 4);
echo $data;
}
?>