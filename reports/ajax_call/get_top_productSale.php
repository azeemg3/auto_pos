<?php
require_once'../../inc.func.php';
if(!empty($_POST))
{
	if(!empty($_POST['df']) && !empty($_POST['dt']))
	{
		$df=$_POST['df'];
		$dt=$_POST['dt'];
		$whereArray[]="STR_TO_DATE(sale_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$df', '%d-%m-%Y') AND STR_TO_DATE('$dt', '%d-%m-%Y ')";
	}
	//if(!empty($_POST['client_id'])) $whereArray[]="client_id=".$_POST['client_id']."";
}
else
{
	$whereArray[]="STR_TO_DATE(sale_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$cm->today()."', '%d-%m-%Y') AND STR_TO_DATE('".$cm->today()."', '%d-%m-%Y ')";
}
$count=1;
$sWhere = implode(" AND ", $whereArray);
$result=$cm->selectMultiData("sum(qty) AS total_qty, product_id","stock_details", 
"{$sWhere} GROUP BY product_id ORDER BY total_qty DESC");
$data=""; $st=0;
while($row=$result->fetch_assoc())
{
	$data.='
			<tr>
				<td>'.$count++.'</td>
				<td>'.$cm->u_value("products", "product_name", "product_id=".$row['product_id']."").'</td>
				<td>'.$row['total_qty'].'</td>
			</tr>
		';
}
echo $data;
?>