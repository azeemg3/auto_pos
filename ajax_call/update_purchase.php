<?php
require_once'../inc.func.php';
session_start();
if(isset($_POST) && !empty($_POST['vendor_id']) && !empty($_POST['net_total']))
{
	$pId=$_GET['pId'];
	$data['vendor_id']=$_POST['vendor_id'];
	$data['purchase_date']=$_POST['purchase_date'];
	$data['descriptions']=$_POST['descriptions'];
	$data['sub_total']=$_POST['sub_total'];
	$data['net_total']=$_POST['net_total'];
	$data['userId']=$_SESSION['sessionId'];
	$trans_code=$cm->u_value("purchase_invoice","trans_code","p_id=".$pId."");
	$paid=$cm->u_value("purchase_invoice","paid","p_id=".$pId."");
	$data['paid']=$_POST['paid'];
	$cm->update_array("purchase_invoice", $data, "p_id=".$pId."");
	//$pi_id=$cm->u_value("purchase_invoice", "p_id", "1 ORDER BY p_id DESC");
	$cm->delete("stock_details", "pi_id=".$pId."");
	$tp=count($_POST['product_id']);
	for($i=0; $i<=$tp; $i++)
	{
		if(!empty($_POST['product_id'][$i]) && !empty($_POST['total'][$i]))
		{
			$cm->insertData_multi("stock_details", "product_id, rate, qty, total, userId, purchase_date, date_time, type, 
			pi_id, trans_code",
			"'".$_POST['product_id'][$i]."', '".$_POST['rate'][$i]."', '".$_POST['qty'][$i]."', '".$_POST['total'][$i]."',
			".$_SESSION['sessionId'].", '".$_POST['purchase_date']."',NOW(), 'p',".$pId.",".$trans_code."");
		}
	}
	//cr to vendor when purchase from vendor
	$data_trans['trans_acc_id']=$_POST['vendor_id'];
	$data_trans['amount']=$_POST['net_total'];
	$data_trans['dr_cr']='cr';
	$data_trans['status']='approved';
	$data_trans['narration']='Purchase From: '.$cm->u_value("trans_acc","trans_acc_name", "trans_acc_id=".$_POST['vendor_id']."").'';
	$data_trans['userId']=$_SESSION['sessionId'];
	$cm->update_array("trans", $data_trans, "trans_code=".$trans_code." AND dr_cr='cr' AND vt='P_V'");
	// dr to vendor when paid amount to vendor
	if(isset($_POST['paid']) && !empty($_POST['vendor_id']))
	{
		$data_transDr['trans_acc_id']=$_POST['vendor_id'];
		$data_transDr['amount']=$_POST['paid'];
		$data_transDr['dr_cr']='dr';
		$data_transDr['status']='approved';
		$data_transDr['trans_date']=$_POST['purchase_date'];
		$data_transDr['trans_code']=$trans_code;
		$data_transDr['vt']='PV';
		$data_transDr['narration']='To: '.$cm->u_value("trans_acc","trans_acc_name", "trans_acc_id=".$_POST['vendor_id']."").' Against Invoice #'.$cm->serial($pId).'';
		$data_transDr['userId']=$_SESSION['sessionId'];
		if($paid>0)
		{
		$cm->update_array("trans", $data_transDr, "trans_code=".$trans_code." AND dr_cr='dr' AND vt='PV'");
		}
		else
		{
			if($_POST['paid']>0)
			{
				$cm->insert_array("trans", $data_transDr, "create_date","NOW()");
			}
		}
	}
	//cr account from which payment paid
		$data_transCr['trans_acc_id']='15';
		$data_transCr['amount']=$_POST['paid'];
		$data_transCr['dr_cr']='cr';
		$data_transCr['status']='approved';
		$data_transCr['trans_date']=$_POST['purchase_date'];
		$data_transCr['trans_code']=$trans_code;
		$data_transCr['vt']='PV';
		$data_transCr['narration']='From: '.$cm->u_value("trans_acc","trans_acc_name", "trans_acc_id='15'").' Against Invoice #'.$cm->serial($pId).'';
		$data_transDr['userId']=$_SESSION['sessionId'];
		if($paid>0)
		{
			$cm->update_array("trans", $data_transCr, "trans_code=".$trans_code." AND dr_cr='cr' AND vt='PV'");
			$cm->delete("trans", "trans_code=".$trans_code." AND amount=0.00");
		}
		else
		{
			if($_POST['paid']>0)
			{
			$cm->insert_array("trans", $data_transCr, "create_date","NOW()");
			$cm->delete("trans", "trans_code=".$trans_code." AND amount=0.00");
			}
		}
	echo 1;
}
else
{
	echo "0";
}
?>