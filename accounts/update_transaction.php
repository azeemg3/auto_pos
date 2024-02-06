<?php
require_once'../inc.func.php';
session_start();
$msg="";
print_r($_POST);
if(isset($_POST) && !empty($_POST['trans_from']) && !empty($_POST['trans_to']) && !empty($_POST['amount']) && 
!empty($_POST['trans_code']))
{
	//affect credit sites of the transaction account
	$data=array();
	$trans_code=$_POST['trans_code'];
	$thisData=array();
	$data['trans_date']=$_POST['trans_date'];
	$data['trans_acc_id']=$_POST['trans_from'];
	$data['amount']=$_POST['amount'];
	$data['userId']=$_SESSION['sessionId'];
	$data['branch_id']=$_SESSION['branch_id'];
	$data['status']='approved';
	$data['dr_cr']='cr';
	$data['vt']=$_POST['vt'];
	$data['narration']=$_POST['short_address'].'-To:'.$cm->u_value("trans_acc","trans_acc_name","trans_acc_id=".$_POST['trans_to']."").'';
	$cm->update_array("trans", $data, "trans_code=".$trans_code." AND dr_cr='cr' AND status='approved'");
	// affect debit site of the transaction account
	$thisData['trans_date']=$_POST['trans_date'];
	$thisData['trans_acc_id']=$_POST['trans_to'];
	$thisData['amount']=$_POST['amount'];
	$thisData['userId']=$_SESSION['sessionId'];
	$thisData['branch_id']=$_SESSION['branch_id'];
	$thisData['status']='approved';
	$thisData['dr_cr']='dr';
	$thisData['vt']=$_POST['vt'];
	$thisData['narration']=$_POST['short_address'].'-FROM:'.$cm->u_value("trans_acc","trans_acc_name","trans_acc_id=".$_POST['trans_from']."").'';
	$cm->update("trans", $thisData, "trnas_code=".$trans_code." AND status='approved' AND dr_cr='dr'");
	header("location:transactions");
}
else
{
	echo $msg=2;
}
?>