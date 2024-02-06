<?php
require_once'../inc.func.php';
$sWhere="";$whereArray=array();
if(!empty($_POST))
{
	if(!empty($_POST['df']))
	{
		$df=$_POST['df'];
		$whereArray[]="STR_TO_DATE(sale_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$df', '%d-%m-%Y') AND STR_TO_DATE('$df', '%d-%m-%Y ')";
	}
	if(!empty($_POST['inv_no'])) $whereArray[]="s_id=".$_POST['inv_no']."";
	$sWhere = implode(" AND ", $whereArray);
}
else
{
	$sWhere="1";
}
$result=$cm->selectData("sale_invoice", "{$sWhere} ORDER BY s_id DESC LIMIT 30");
$data=""; $st=0;
while($row=$result->fetch_assoc())
{
	$data.='
			<tr id="'.$row['s_id'].'">
				<td>'.$cm->serial($row['s_id']).'</td>
				<td>'.$row['sale_date'].'</td>
				<td>'.$cm->u_value("trans_acc", "trans_acc_name", "trans_acc_id=".$row['client_id']."").'</td>
				<td>'.$cm->show_bal_format($row['net_total']).'</td>
				
				<td width="15%">
					<a class="btn btn-app" target="_blank" href="print_inv?invId='.$row['s_id'].'"><i class="fa fa-print"></i></a>
					<a class="btn btn-app" href="javascript:void(0)" onClick="sale_invoice_view('.$row['s_id'].')">
					<i class="fa fa-eye"></i></a>
					<a  class="btn btn-app" href="edit_si?id='.$row['s_id'].'"><i class="fa fa-edit"></i></a>
					<a  class="btn btn-app" href="javascript:void(0)" onclick="del_rec(\''.$row['s_id'].'\', \'saleInv\',\'\')"><i class="fa fa-remove"></i></a>
				</td>
			</tr>
		';
		//$st+=$row['net_total'];
}
      /*$data.='<tr>
	  			<td colspan="3" align="right"><strong>Total Amount</strong></td>
				<td colspan="2"><strong>'.$cm->show_bal_format($st).'</strong></td>
				
	  		</tr>';*/
echo $data;
?>