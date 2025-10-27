<?php
require_once '../inc.func.php';
if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
	$product_id = $_GET['product_id'];
	if (isset($_GET['client_id'])) {
		$client_id = $_GET['client_id'];
		$pv=$cm->u_value('stock_details sd JOIN sale_invoice si ON sd.si_id = si.s_id','sd.rate','si.client_id='.$client_id.' 
		AND sd.product_id='.$product_id.' ORDER BY s_id DESC LIMIT 1');
	}else{
		$pv=0;
	}
	$tos = $cm->u_total("opening_stock", "qty", "product_id=" . $product_id . "");
	$tpq = $cm->u_total("stock_details", "qty", "product_id=" . $product_id . " AND type='p'");
	$tsq = $cm->u_total("stock_details", "qty", "product_id=" . $product_id . " AND type='s'");
	$tbq = $cm->u_total("stock_details", "bonus_qty", "product_id=" . $product_id . " AND type='s'");
	$rq = $tos + $tpq - $tsq - $tbq;
	if ($rq > 0) {
		echo "Rem Qty:" . $rq.' ('.$pv.')'.'~'.$pv;
	} else {
		echo 'No Quantity ('.$pv.')'.'~'.$pv;
	}
}
