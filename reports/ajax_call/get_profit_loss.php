<?php
require_once'../../inc.func.php';
$data="";
$sWhere="";$whereArray=array();
if(!empty($_POST))
{
	if(!empty($_POST['df']) && !empty($_POST['dt']))
	{
		$df=$_POST['df'];
		$dt=$_POST['dt'];
		$whereArray[]="STR_TO_DATE(sale_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$df', '%d-%m-%Y') AND STR_TO_DATE('$dt', '%d-%m-%Y ')";
	}
	/*if(!empty($_POST['inv_no'])) $whereArray[]="s_id=".$_POST['inv_no']."";*/
	$sWhere = implode(" AND ", $whereArray);
}
else
{
	$sWhere="STR_TO_DATE(sale_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$cm->today()."', '%d-%m-%Y') AND STR_TO_DATE('".$cm->today()."', '%d-%m-%Y ')";
}
$result=$cm->selectData("sale_invoice","{$sWhere}");
$net_sale=0; $stp=0; $sts=0; $tpl=0;
while($row=$result->fetch_assoc())
{
	//total purchase of invoice
	$tp=0; $tb=0;
	$query=$cm->selectMultiData("p_rate, qty, bonus_qty", "stock_details", "si_id=".$row['s_id']." AND type='s'");
	while($pRow=$query->fetch_assoc())
	{
		$tp+=$pRow['p_rate']*$pRow['qty'];
		$tb+=$pRow['p_rate']*$pRow['bonus_qty'];
	}
	$net_sale=($row['net_total'])-($row['bonus']);
	$data.='
			<tr>
				<td>'.$cm->serial($row['s_id']).'</td>
				<td>'.$row['sale_date'].'</td>
				<td>'.$cm->show_bal_format($tp).'</td>
				<td>'.$cm->show_bal_format($net_sale).'</td>
				<td>'.$cm->show_bal_format($net_sale-$tp).'</td>
			</tr>
		';
		$stp+=$tp;
		$sts+=$net_sale;
		$tpl+=$net_sale-$tp;
}
		$data.=
			'<tr>
				<td align="right" colspan="2"><strong>Total</strong></td>
				<td>'.$cm->show_bal_format($stp).'</td>
				<td>'.$cm->show_bal_format($sts).'</td>
				<td>'.$cm->show_bal_format($tpl).'</td>
			</tr>
			';
echo $data;
?>