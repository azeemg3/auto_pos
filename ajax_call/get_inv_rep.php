<?php
require_once'../inc.func.php';
$sWhere="";$whereArray=array();
$df=""; $dt="";
if(!empty($_POST))
{
	if(!empty($_POST['df']) && !empty($_POST['dt']))
	{
		$df=$_POST['df'];
		$dt=$_POST['dt'];
		$whereArray[]="STR_TO_DATE(sale_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$df', '%d-%m-%Y') AND STR_TO_DATE('$dt', '%d-%m-%Y ')";
	}
	if(!empty($_POST['inv_no'])) $whereArray[]="s_id=".$_POST['inv_no']."";
	if(!empty($_POST['client_id'])) $whereArray[]="client_id=".$_POST['client_id']."";
}
else
{
	$whereArray[]="STR_TO_DATE(sale_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$cm->today()."', '%d-%m-%Y') AND STR_TO_DATE('".$cm->today()."', '%d-%m-%Y ')";
}
$sWhere = implode(" AND ", $whereArray);
$result=$cm->selectData("sale_invoice", "{$sWhere}");
$data=""; $st=0;
while($row=$result->fetch_assoc())
{
	$data.='
			<tr>
				<td>'.$cm->serial($row['s_id']).'</td>
				<td>'.$row['sale_date'].'</td>
				<td>'.$cm->u_value("trans_acc", "trans_acc_name", "trans_acc_id=".$row['client_id']."").'</td>
				<td>'.$cm->show_bal_format($row['sub_total']-$row['discount']).'</td>
			</tr>
		';
		$st+=$row['net_total'];
}
      $data.='<tr>
	  			<td colspan="3" align="right"><strong>Total Amount</strong></td>
				<td colspan="2"><strong>'.$cm->show_bal_format($st).'</strong></td>
				
	  		</tr>';
echo $data;
?>