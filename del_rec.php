<?php
require_once'inc.func.php';
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$id=$_GET['id'];
}
if(isset($_GET['type']) && $_GET['type']=='saleInv')
{
	$transCode=$cm->u_value("sale_invoice","trans_code","s_id=".$id."");
	$cm->update("trans", "status='cancel'", "trans_code=".$transCode."");
	$cm->delete("sale_invoice","s_id=".$id."");
	$cm->delete("stock_details","si_id=".$id."");
}
else if(isset($_GET['type']) && $_GET['type']=='purInv')
{
	$transCode=$cm->u_value("purchase_invoice","trans_code","p_id=".$id."");
	$cm->update("trans", "status='cancel'", "trans_code=".$transCode."");
	$cm->delete("purchase_invoice","p_id=".$id."");
	$cm->delete("stock_details","pi_id=".$id."");
}
else if(isset($_GET['type']) && $_GET['type']=='trans')
{
	$cm->update("trans", "status='cancel'", "trans_code=".$id."");
}
else if(isset($_GET['type']) && $_GET['type']=='area')
{
	$cm->delete("areas","area_id=".$id."");
}
?>