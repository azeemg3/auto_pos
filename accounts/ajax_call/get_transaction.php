<?php
require_once'../../inc.func.php';
$data=""; $date=""; $id="";
$sWhere="";
$whereArr=array();
if(isset($_POST))
{
	if(!empty($_POST['df']) && !empty($_POST['dt']))
	{
		$df=$_POST['df'];
		$dt=$_POST['dt'];
		$whereArr[]="STR_TO_DATE(trans_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$df', '%d-%m-%Y') AND STR_TO_DATE('$dt', '%d-%m-%Y ')";
	}
	if(!empty($_POST['trans_acc']))
	{
		$whereArr[]="trans_acc_id=".$_POST['trans_acc']."";
	}
	else
	{
		$whereArr[]="status='approved' AND vt!='SV' AND vt!='P_V'";
	}
	$sWhere=implode(" AND ", $whereArr);
	$result=$cm->selectData("trans","{$sWhere} GROUP BY trans_code ORDER BY trans_id DESC LIMIT 30");
	while($row=$result->fetch_assoc())
	{
		$id=$row['trans_code'];
		$data.='
		<tr id="'.$row['trans_code'].'">
			<td width="2%">'.$cm->serial($row['trans_code']).'</td>
			<td width="10%">'.$row['trans_date'].'</td>
			<td>'.$cm->u_value("trans_acc","trans_acc_name","trans_acc_id=".$row['trans_acc_id']."").'</td>
			<td>'.$row['narration'].'</td>
			<td width="5%">'.$row['amount'].'</td>
			<td width="10%">
					<!--<a class="btn btn-app" target="_blank" href="print_inv?invId=1"><i class="fa fa-print"></i></a>-->
					<a class="btn btn-app" href="transaction_edit?trans_code='.$row['trans_code'].'"><i class="fa fa-edit"></i></a>
					<a class="btn btn-app" href="javascript:void(0)" onclick="del_rec(\''.$row['trans_code'].'\', \'trans\',
					\'../\')">
					<i class="fa fa-remove"></i></a>
			</td>
		</tr>
		';
	}
	$data.=$cm->nothing_found($id,4);
	echo $data;
}
?>