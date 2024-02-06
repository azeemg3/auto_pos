<?php
require_once'../inc.func.php';
$sWhere="";$whereArray=array();
if(isset($_POST) && !empty($_POST))
{
	if(!empty($_POST['df']) && !empty($_POST['dt']))
	{
		$df=$_POST['df'];
		$dt=$_POST['dt'];
		$whereArray[]="STR_TO_DATE(purchase_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$df', '%d-%m-%Y') AND STR_TO_DATE('$dt', '%d-%m-%Y ')";
	}
	if(!empty($_POST['vendor_id'])) $whereArray[]="vendor_id=".$_POST['vendor_id']."";
	else $whereArray[]="STR_TO_DATE(purchase_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$cm->today()."', '%d-%m-%Y') AND STR_TO_DATE('".$cm->today()."', '%d-%m-%Y ')";
}
else
{
	$whereArray[]="STR_TO_DATE(purchase_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$cm->today()."', '%d-%m-%Y') AND STR_TO_DATE('".$cm->today()."', '%d-%m-%Y ')";
}
$sWhere = implode(" AND ", $whereArray);
$result=$cm->selectData("purchase_invoice", "{$sWhere}");
$data=""; $st=0;
while($row=$result->fetch_assoc())
{
	$data.='
			<tr>
				<td>'.$row['purchase_date'].'</td>
				<td>'.$cm->u_value("trans_acc", "trans_acc_name", "trans_acc_id=".$row['vendor_id']."").'</td>
				<td>'.$cm->show_bal_format($row['net_total']).'</td>
			</tr>
		';
		$st+=$row['net_total'];
}
      $data.='<tr>
	  			<td colspan="2" align="right"><strong>Total Amount</strong></td>
				<td colspan="2"><strong>'.$cm->show_bal_format($st).'</strong></td>
				
	  		</tr>';
echo $data;
?>