<?php
require_once'../inc.func.php';
session_start();
if(isset($_POST) && !empty($_POST['client_id']))
{
	if(!empty($_POST['net_total']))
	{
	$data['client_id']=$_POST['client_id'];
	$data['sale_date']=$_POST['sale_date'];
	$data['descriptions']=$_POST['descriptions'];
	$data['sub_total']=$_POST['sub_total'];
	$data['gst']=$_POST['gst'];
	$data['net_total']=$_POST['net_total'];
	$data['userId']=$_SESSION['sessionId'];
	$data['trans_code']=$cm->trans_code();
	$data['receive']=$_POST['receive'];
	$data['discount']=$_POST['discount'];
	$cm->insert_array("sale_invoice", $data, "date_time", "NOW()");
	$si_id=$cm->u_value("sale_invoice", "s_id", "1 ORDER BY s_id DESC");
	$tc=$cm->u_value("sale_invoice", "trans_code", "1 ORDER BY s_id DESC");
	$tp=count($_POST['product_id']);
	$tb=0;
	for($i=0; $i<$tp; $i++)
	{
		$pRate=$cm->u_value("products", "purchase_price", "product_id=".$_POST['product_id'][$i]."");
		$batch=$cm->u_value("products", "batch", "product_id=".$_POST['product_id'][$i]."");
		//$tb+=$pRate*($_POST['bonus_qty'][$i]);
		if(!empty($_POST['product_id'][$i]) && !empty($_POST['total'][$i]))
		{
			$cm->insertData_multi("stock_details", "product_id, rate, qty, total, userId, sale_date, date_time, type, 
			si_id, trans_code, p_rate, batch",
			"'".$_POST['product_id'][$i]."', '".$_POST['rate'][$i]."', '".$_POST['qty'][$i]."','".$_POST['total'][$i]."',
			".$_SESSION['sessionId'].", '".$_POST['sale_date']."',NOW(), 's',".$si_id.",".$cm->trans_code().", 
			'".$pRate."', '".$batch."'");
		}
	}
	//cr to vendor when purchase from vendor
	$data_trans['trans_acc_id']=$_POST['client_id'];
	$data_trans['amount']=$_POST['net_total'];
	$data_trans['dr_cr']='dr';
	$data_trans['status']='approved';
	$data_trans['trans_date']=$_POST['sale_date'];
	$data_trans['trans_code']=$tc;
	$data_trans['vt']='SV';
	$data_trans['narration']='Sales To: '.$cm->u_value("trans_acc","trans_acc_name", "trans_acc_id=".$_POST['client_id']."").'
	 Against Invoice #'.$cm->serial($si_id).'';
	$data_trans['userId']=$_SESSION['sessionId'];
	$cm->insert_array("trans", $data_trans, "create_date","NOW()");
	$cm->update("sale_invoice", "bonus='".$tb."'", "s_id=".$si_id."" );
	if(!empty($_POST['receive']))
	{
		$data_transCr['trans_acc_id']=$_POST['client_id'];
		$data_transCr['amount']=$_POST['receive'];
		$data_transCr['dr_cr']='cr';
		$data_transCr['status']='approved';
		$data_transCr['trans_date']=$_POST['sale_date'];
		$data_transCr['trans_code']=$tc;
		$data_transCr['vt']='RV';
		$data_transCr['narration']='Receive From: '.$cm->u_value("trans_acc","trans_acc_name", "trans_acc_id=".$_POST['client_id']."").' Against Invoice #'.$cm->serial($si_id).'';
		$data_transCr['userId']=$_SESSION['sessionId'];
		$cm->insert_array("trans", $data_transCr, "create_date","NOW()");
	}
	if(!empty($_POST['receive']) && !empty($_POST['acc_to']))
	{
		$data_transDr['trans_acc_id']='15';
		$data_transDr['amount']=$_POST['receive'];
		$data_transDr['dr_cr']='dr';
		$data_transDr['status']='approved';
		$data_transDr['trans_date']=$_POST['sale_date'];
		$data_transDr['trans_code']=$tc;
		$data_transDr['trans_code']='RV';
		$data_transDr['narration']='To: '.$cm->u_value("trans_acc","trans_acc_name", "trans_acc_id=".$_POST['acc_to']."").' Against Invoice #'.$cm->serial($si_id).'';
		$data_transDr['userId']=$_SESSION['sessionId'];
		$cm->insert_array("trans", $data_transDr, "create_date","NOW()");
	}
	echo 1,'~',$si_id;
	}
	else
	{
		echo "Net Total Should not be 0, Please Fill Form Properly:";
	}
}
else
{
	echo "Please Select Client A/C";
}
?>