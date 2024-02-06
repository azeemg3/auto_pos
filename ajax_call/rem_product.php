<?php
require_once'../inc.func.php';
if(isset($_GET['product_id']) && !empty($_GET['product_id']))
{
	$product_id=$_GET['product_id'];
	$tos=$cm->u_total("opening_stock", "qty", "product_id=".$product_id."");
	$tpq=$cm->u_total("stock_details", "qty", "product_id=".$product_id." AND type='p'");
	$tsq=$cm->u_total("stock_details", "qty", "product_id=".$product_id." AND type='s'");
	$tbq=$cm->u_total("stock_details", "bonus_qty", "product_id=".$product_id." AND type='s'");
	$rq=$tos+$tpq-$tsq-$tbq;
	if($rq>0){
	echo "Rem Qty:".$rq;}
	else
	{
		echo 'No Quantity';
	}
}
?>
