<?php
require_once'../../inc.func.php';
if(isset($_POST['trans_acc_id']) && !empty($_POST['trans_acc_id']))
{
	$trans_acc_id=$_POST['trans_acc_id'];
	$ob_result=$cm->selectData("trans_acc","trans_acc_id=".$trans_acc_id." LIMIT 1");
	$balance=0;
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
		$balance+=$cm->ob($dt_frm,$dt_to,$ob_row['trans_acc_id']);
		$arrayofArray[]=array('trans_acc_name'=>$ob_row['trans_acc_name'],"description"=>'Opening Balance As At '.$dt_frm.'',
		"debit"=>''.(($cm->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])>0)?'
			'.$cm->show_bal_format($cm->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])).'':"0.00").'',
			"credit"=>''.(($cm->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])<0)?'
			'.number_format(abs($cm->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])),2).'':"0.00").'',
			"balance"=>$cm->show_bal($balance));
		$array['ob']=$arrayofArray;
	}
	
	$bal=0;
	$newArray=array();
	$array['allData']=""; $tdr=0;$tcr=0;
	$result=$cm->selectData("trans","{$sWhere}");
	while($row=$result->fetch_assoc())
	{
	   if($row['dr_cr']=='dr'){$bal+=$row['amount'];}
	   elseif($row['dr_cr']=='cr'){$bal+='-'.$row['amount'];}
	   $tdr+=(($row['dr_cr']=='dr')?''.($row['amount']).'':"0.00");
	   $tcr+=(($row['dr_cr']=='cr')?''.($row['amount']).'':"0.00");
	   $newArray[]=array("trans_date"=>$row['trans_date'],"trans_acc_name"=>$cm->u_value("trans_acc","trans_acc_name","trans_acc_id=".$row['trans_acc_id'].""),
	   "narration"=>$row['narration'],
	   "debit"=>(($row['dr_cr']=='dr')?''.($cm->show_bal_format($row['amount'])).'':"0.00"),
	   "credit"=>(($row['dr_cr']=='cr')?''.($cm->show_bal_format($row['amount'])).'':"0.00"),
	   "balance"=>$cm->show_bal($bal+$balance),"voucher"=>$cm->serial($row['trans_code']));
	   $array['allData']=$newArray;
	}
	$array['total_balance']=array("t_dr"=>$cm->show_bal_format($tdr),"t_cr"=>$cm->show_bal_format($tcr), 
	"tbal"=>$cm->show_bal($balance+$tdr-$tcr));
	echo json_encode($array);
}
?>