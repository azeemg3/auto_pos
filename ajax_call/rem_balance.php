<?php
require_once'../inc.func.php';
if(isset($_GET['cId']) && !empty($_GET['cId']))
{
	$cId=$_GET['cId'];
	$cdr=$cm->u_total("trans", "amount", "trans_acc_id=".$cId." AND dr_cr='dr' AND status='approved'");
	$ccr=$cm->u_total("trans", "amount", "trans_acc_id=".$cId." AND dr_cr='cr' AND status='approved'");
	$cbal=$cdr-$ccr;
	echo "Remaining Balance is: ".$cbal;
	
}
?>