<?php
require_once'../inc.func.php';
$fd=""; $count=1;
$sWhere=""; $rid="";
if(!empty($_POST['ser_product']))
{
	$sWhere="product_id=".$_POST['ser_product']."";
}
else
{
	$sWhere="1";
}
$result=$cm->selectData("products", "{$sWhere}  ORDER BY product_id DESC limit 20");
while($row=$result->fetch_assoc())
{
	$pId=$row['product_id'];
	$pq=$cm->u_total("opening_stock","qty","product_id=".$row['product_id']."")+$cm->u_total("stock_details", "qty","product_id=".$row['product_id']." AND type='p'");
	$sq=$cm->u_total("stock_details", "qty","product_id=".$row['product_id']." AND type='s'");
	$rq=$pq-$sq;
	if($rq>0){
	$fd.='<tr>
			<td>'.$row['product_name'].'</td>
			<td>'.$cm->u_value("brands", "brand_name", "brand_id=".$row['brand_id']."").'</td>
			<td>'.$rq.'</td>
		  </tr>
		';
	}
}
$fd.=$cm->nothing_found($pId, 5);
echo $fd;
?>