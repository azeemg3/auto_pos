<?php
require_once'../../inc.func.php';
if(isset($_POST['trans_acc_id']) && !empty($_POST['trans_acc_id']))
{
	$trans_acc_id=$_POST['trans_acc_id'];
	$ob_result=$cm->selectData("trans_acc","trans_acc_id=".$trans_acc_id." LIMIT 1");
	$balance="";
	$array=array();	
	$arrayofArray=array();
	$whereArray=array();
	$sWhere="";
	if(!empty($_POST['dt_frm']) && !empty($_POST['dt_to']))
	{
		$dt_frm=$_POST['dt_frm'];
		$dt_to=$_POST['dt_to'];
		$whereArray[]="STR_TO_DATE(trans_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$dt_frm', '%d-%m-%Y') AND STR_TO_DATE('$dt_to', '%d-%m-%Y ') AND status='approved' AND trans_acc_id=".$trans_acc_id.""; 
		$sWhere = implode(" AND ", $whereArray);
	}
	while($ob_row=$ob_result->fetch_assoc())
	{
		$balance+=$administrator->ob($dt_frm,$dt_to,$ob_row['trans_acc_id']);
		$arrayofArray[]=array('trans_acc_name'=>$ob_row['trans_acc_name'],"description"=>'Opening Balance As At '.$dt_frm.'',
		"debit"=>''.(($administrator->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])>0)?'
			'.number_format(abs($administrator->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])),2).'':"").'',
			"credit"=>''.(($administrator->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])<0)?'
			'.number_format(abs($administrator->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])),2).'':"").'',
			"balance"=>$cm->show_bal($balance));
		$array['ob']=$arrayofArray;
	}
	$bal="";
	$newArray=array();
	$result=$cm->selectData("trans","{$sWhere}");
	while($row=$result->fetch_assoc())
	{
	   if($row['dr_cr']=='dr'){$bal+=$row['amount'];}
	   elseif($row['dr_cr']=='cr'){$bal+='-'.$row['amount'];}
	   $newArray[]=array("trans_date"=>$row['trans_date'],"trans_acc_name"=>$cm->u_value("trans_acc","trans_acc_name","trans_acc_id=".$row['trans_acc_id'].""),
	   "narration"=>$row['narration'],
	   "debit"=>(($row['dr_cr']=='dr')?''.number_format($row['amount']).'':"0.00"),
	   "credit"=>(($row['dr_cr']=='cr')?''.number_format($row['amount']).'':"0.00"),
	   "balance"=>$cm->show_bal($bal+$balance),"voucher"=>$row['vt']."-".$cm->serial($row['trans_code']));
	   $array['allData']=$newArray;
	}
	echo json_encode($array);
}
?>