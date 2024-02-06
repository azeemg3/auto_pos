<?php
require_once'../inc.func.php';
session_start();
$msg="";
if(isset($_POST) && !empty($_POST['trans_from']) && !empty($_POST['trans_to']) && !empty($_POST['amount']))
{
	//affect credit sites of the transaction account
	$data=array();
	$thisData=array();
	$data['trans_date']=$_POST['trans_date'];
	$data['trans_acc_id']=$_POST['trans_from'];
	$data['amount']=$_POST['amount'];
	$data['userId']=$_SESSION['sessionId'];
	$data['branch_id']=$_SESSION['branch_id'];
	$data['status']='approved';
	$data['dr_cr']='cr';
	$data['vt']=$_POST['vt'];
	$data['trans_code']=$cm->trans_code();
	$data['narration']=$_POST['short_address'].'-To:'.$cm->u_value("trans_acc","trans_acc_name","trans_acc_id=".$_POST['trans_to']."").'';
	$cm->insert_array("trans", $data, "create_date", "NOW()");
	// affect debit site of the transaction account
	$thisData['trans_date']=$_POST['trans_date'];
	$thisData['trans_acc_id']=$_POST['trans_to'];
	$thisData['amount']=$_POST['amount'];
	$thisData['userId']=$_SESSION['sessionId'];
	$thisData['branch_id']=$_SESSION['branch_id'];
	$thisData['status']='approved';
	$thisData['dr_cr']='dr';
	$thisData['vt']=$_POST['vt'];
	$thisData['trans_code']=$cm->u_value("trans","trans_code","1 ORDER BY trans_id DESC LIMIT 1");
	$thisData['narration']=$_POST['short_address'].'-FROM:'.$cm->u_value("trans_acc","trans_acc_name","trans_acc_id=".$_POST['trans_from']."").'';
	$cm->insert_array("trans", $thisData, "create_date", "NOW()");
	echo $msg=1;
}
else
{
	echo $msg=2;
}
?>