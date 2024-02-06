<?php
require_once'../inc.func.php';
session_start();
if(isset($_POST) && !empty($_POST['client_id']))
{
	$id=$_GET['sId'];
	$tb=0;
	if(!empty($_POST['net_total']))
	{
	$data['client_id']=$_POST['client_id'];
	$data['sale_date']=$_POST['sale_date'];
	$data['descriptions']=$_POST['descriptions'];
	$data['sub_total']=$_POST['sub_total'];
	$data['gst']=$_POST['gst'];
	$data['net_total']=$_POST['net_total'];
	$data['userId']=$_SESSION['sessionId'];
	$data['receive']=$_POST['receive'];
	$data['discount']=$_POST['discount'];
	$trans_code=$cm->u_value("sale_invoice", "trans_code", "s_id=".$id."");
	$receive=$cm->u_value("sale_invoice", "receive", "s_id=".$id."");
	$cm->update_array("sale_invoice", $data, "s_id=".$id."");
	//$si_id=$cm->u_value("sale_invoice", "s_id", "1 ORDER BY s_id DESC");
	$cm->delete("stock_details", "si_id=".$id."");
	$tp=count($_POST['product_id']);
	for($i=0; $i<$tp; $i++)
	{	
		if(!empty($_POST['product_id'][$i]) && !empty($_POST['total'][$i]))
		{
			$pRate=$cm->u_value("products", "purchase_price", "product_id=".$_POST['product_id'][$i]."");
			//$tb+=$pRate*($_POST['bonus_qty'][$i]);
			$batch=$cm->u_value("products", "batch", "product_id=".$_POST['product_id'][$i]."");
			$cm->insertData_multi("stock_details", "product_id, rate, qty, total, userId, sale_date, date_time, type, 
			si_id, trans_code, p_rate, batch",
			"'".$_POST['product_id'][$i]."', '".$_POST['rate'][$i]."', '".$_POST['qty'][$i]."', '".$_POST['total'][$i]."',
			".$_SESSION['sessionId'].", '".$_POST['sale_date']."',NOW(), 's',".$id.",".$cm->trans_code().", '$pRate', '".$batch."'");
		}
	}
	//$cm->update("sale_invoice", "bonus='".$tb."'", "s_id=".$id."" );
	//dr to Client 
	$data_trans['trans_acc_id']=$_POST['client_id'];
	$data_trans['amount']=$_POST['net_total'];
	$data_trans['dr_cr']='dr';
	$data_trans['status']='approved';
	$data_trans['narration']='Sales To: '.$cm->u_value("trans_acc","trans_acc_name", "trans_acc_id=".$_POST['client_id']."").'
	 Against Invoice #'.$cm->serial($id).'';
	$data_trans['userId']=$_SESSION['sessionId'];
	$cm->update_array("trans", $data_trans, "trans_code=".$trans_code." AND dr_cr='dr' AND vt='SV'");
	// cr to client when receive amount
	if(isset($_POST['receive']) && !empty($_POST['client_id']))
	{
		$data_transCr['trans_acc_id']=$_POST['client_id'];
		$data_transCr['amount']=$_POST['receive'];
		$data_transCr['dr_cr']='cr';
		$data_transCr['status']='approved';
		$data_transCr['trans_date']=$_POST['sale_date'];
		$data_transCr['trans_code']=$trans_code;
		$data_transCr['vt']='RV';
		$data_transCr['narration']='Receive From: '.$cm->u_value("trans_acc","trans_acc_name", "trans_acc_id=".$_POST['client_id']."").' Against Invoice #'.$cm->serial($id).'';
		$data_transCr['userId']=$_SESSION['sessionId'];
		if($receive>0)
		{
			$cm->update_array("trans", $data_transCr, "trans_code=".$trans_code." AND dr_cr='cr' AND vt='RV' ");
		}
		else
		{
			if($_POST['receive']>0)
			{
				$cm->insert_array("trans", $data_transCr, "create_date","NOW()");
			}
		}
	}
	//dr to account in which payment received
	/*if($_POST['receive'])
	{*/
		$data_transDr['trans_acc_id']='15';
		$data_transDr['amount']=$_POST['receive'];
		$data_transDr['dr_cr']='dr';
		$data_transDr['status']='approved';
		$data_transDr['trans_date']=$_POST['sale_date'];
		$data_transDr['trans_code']=$trans_code;
		$data_transDr['narration']='To: '.$cm->u_value("trans_acc","trans_acc_name", "trans_acc_id='15'").' Against Invoice #'.$cm->serial($id).'';
		$data_transDr['userId']=$_SESSION['sessionId'];
		if($receive>0)
		{
			$cm->update_array("trans", $data_transDr, "trans_code=".$trans_code." AND dr_cr='dr' AND vt='RV'");
			$cm->delete("trans", "amount='0.00' AND trans_code=".$trans_code."");
		}
		else
		{
			if($_POST['receive']>0)
			{
			$cm->insert_array("trans", $data_transDr, "create_date","NOW()");
			}
		}
	//}
	echo 1,'~',$id;
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