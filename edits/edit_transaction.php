<?php
require_once'../inc.func.php';
$array=array(); $arrayOfArray=array();
if(isset($_GET['trans_code']) && !empty($_GET['trans_code']))
{
	$trans_code=$_GET['trans_code'];
	$result=$cm->selectData("trans", "trans_code=".$trans_code."");
	$cr_tId=$cm->u_value("trans", "trans_acc_id","trans_code=7 AND dr_cr='cr'");
	$dr_tId=$cm->u_value("trans", "trans_acc_id","trans_code=7 AND dr_cr='dr'");
	$row=$result->fetch_assoc();
		$array=array("trans_date"=>$row['trans_date'], "vt"=>$row['vt'], 
	"from"=>$cr_tId,
	"to"=>$cm->u_value("trans_acc","trans_acc_name","trans_acc_id=".$dr_tId.""), "amount"=>$row['amount'],
	"narration"=>$row['narration']
	);
	echo json_encode($array);
}
?>