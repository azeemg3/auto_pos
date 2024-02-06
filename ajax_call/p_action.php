<?php
require_once'../inc.func.php';
session_start();
if(isset($_POST) && !empty($_POST['vendor_id']) && !empty($_POST['net_total']))
{
	$data['vendor_id']=$_POST['vendor_id'];
	$data['purchase_date']=$_POST['purchase_date'];
	$data['descriptions']=$_POST['descriptions'];
	$data['sub_total']=$_POST['sub_total'];
	$data['net_total']=$_POST['net_total'];
	$data['userId']=$_SESSION['sessionId'];
	$data['trans_code']=$cm->trans_code();
	$data['paid']=$_POST['paid'];
	$cm->insert_array("purchase_invoice", $data, "date_time", "NOW()");
	$pi_id=$cm->u_value("purchase_invoice", "p_id", "1 ORDER BY p_id DESC");
	$tc=$cm->u_value("purchase_invoice", "trans_code", "1 ORDER BY p_id DESC");
	$tp=count($_POST['product_id']);
	for($i=0; $i<=$tp; $i++)
	{
		if(!empty($_POST['product_id'][$i]) && !empty($_POST['total'][$i]))
		{
			$cm->insertData_multi("stock_details", "product_id, rate, qty, total, userId, purchase_date, date_time, type, 
			pi_id, trans_code",
			"'".$_POST['product_id'][$i]."', '".$_POST['rate'][$i]."', '".$_POST['qty'][$i]."', '".$_POST['total'][$i]."',
			".$_SESSION['sessionId'].", '".$_POST['purchase_date']."',NOW(), 'p',".$pi_id.",".$cm->trans_code()."");
		}
	}
	//cr to vendor when purchase from vendor
	$data_trans['trans_acc_id']=$_POST['vendor_id'];
	$data_trans['amount']=$_POST['net_total'];
	$data_trans['dr_cr']='cr';
	$data_trans['status']='approved';
	$data_trans['trans_date']=$_POST['purchase_date'];
	$data_trans['trans_code']=$tc;
	$data_trans['vt']='P_V';
	$data_trans['narration']='Purchase From: '.$cm->u_value("trans_acc","trans_acc_name", "trans_acc_id=".$_POST['vendor_id']."").'';
	$data_trans['userId']=$_SESSION['sessionId'];
	$cm->insert_array("trans", $data_trans, "create_date","NOW()");
	if($_POST['paid']>0 && !empty($_POST['vendor_id']))
	{
		$data_transDr['trans_acc_id']=$_POST['vendor_id'];
		$data_transDr['amount']=$_POST['paid'];
		$data_transDr['dr_cr']='dr';
		$data_transDr['status']='approved';
		$data_transDr['trans_date']=$_POST['purchase_date'];
		$data_transDr['trans_code']=$tc;
		$data_transDr['vt']='PV';
		$data_transDr['narration']='To: '.$cm->u_value("trans_acc","trans_acc_name", "trans_acc_id=".$_POST['vendor_id']."").' Against Invoice #'.$cm->serial($pi_id).'';
		$data_transDr['userId']=$_SESSION['sessionId'];
		$cm->insert_array("trans", $data_transDr, "create_date","NOW()");
	}
	if($_POST['paid']>0 && !empty($_POST['acc_frm']))
	{
		$data_transCr['trans_acc_id']='15';
		$data_transCr['amount']=$_POST['paid'];
		$data_transCr['dr_cr']='cr';
		$data_transCr['status']='approved';
		$data_transCr['trans_date']=$_POST['purchase_date'];
		$data_transCr['trans_code']=$tc;
		$data_transCr['vt']='PV';
		$data_transCr['narration']='From: '.$cm->u_value("trans_acc","trans_acc_name", "trans_acc_id=".$_POST['acc_frm']."").' Against Invoice #'.$cm->serial($pi_id).'';
		$data_transDr['userId']=$_SESSION['sessionId'];
		$cm->insert_array("trans", $data_transCr, "create_date","NOW()");
	}
	echo 1;
}
else
{
	echo "Please Select Vendor A/C";
}
?>